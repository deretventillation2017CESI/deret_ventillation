<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Ventilation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Ventilation controller.
 *
 * @Route("ventilation")
 */
class VentilationController extends Controller {

    /**
     * Lists all ventilation entities.
     *
     * @Route("/", name="ventilation_index")
     * @Method({"GET", "POST"}))
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $ventilation = $em->getRepository('AppBundle:Ventilation')->findBy(
            array("utilisateur" => $this->getUser()->getId(), "dateSaisie" => new \DateTime()));
        $activites = $em->getRepository('AppBundle:Activite')->findBy(
            array("user"=>$this->getUser()->getId(),"date"=> new \DateTime()));
        $autreactivites = $em->getRepository('AppBundle:AutreActivite')->findBy(
            array("user"=>$this->getUser()->getId(),"date"=> new \DateTime()));
        $anomalies = $em->getRepository('AppBundle:Anomalies')->findBy(
            array("user"=>$this->getUser()->getId(),"date"=> new \DateTime()));

        $tempsActivite = 0;
        $tempsAutreActivite = 0;
        $tempsAnomalie = 0;

        foreach ($activites as $activite){
            $tempsActivite = $tempsActivite + $activite->getTemps();
        }
        foreach ($autreactivites as $autreActivite){
            $tempsAutreActivite = $tempsAutreActivite + $autreActivite->getTemps();
        }
        foreach ($anomalies as $anomalie){
            $tempsAnomalie = $tempsAnomalie + $anomalie->getTemps();
        }

        $tempsJournalier = $tempsActivite+$tempsAutreActivite+$tempsAnomalie;

        /* $ventilations = $em->getRepository('AppBundle:Ventilation')->findAll();
        $typeActivite = $em->getRepository('AppBundle:TypeActivite')->findAll();*/

        if($request->request->get('typeActivite')){
            return $this->redirectToRoute('ventilation_new', array('id' => $request->request->get('typeActivite')));
        }

        return $this->render('ventilation/index.html.twig', array(
            "ventilation" => $ventilation,
            'activites'=> $activites,
            'autreActivites'=> $autreactivites,
            'anomalies' => $anomalies,
            'tempsActivite' => $tempsActivite,
            'tempsAutreActivite' => $tempsAutreActivite,
            'tempsAnomalie' => $tempsAnomalie,
            'tempsJournalier' => $tempsJournalier
             ));
    }

    /**
     * @Route("/demarrer", name="ventilation_demarrer")
     * @Method({"GET", "POST"})
     */
    public function demarrerAction(){
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('AppBundle:Utilisateur')->find($this->getUser()->getId());
        $ventilation = new Ventilation();
        $ventilation->setDateSaisie(new \DateTime());
        $ventilation->setUtilisateur($user);
        $ventilation->setValidation(false);

        $em->persist($ventilation);
        $em->flush();

        return $this->redirectToRoute('ventilation_index');
    }

    /**
     * @Route("/responsable", name="ventilation_responsable")
     * @Method({"GET", "POST"})
     */
    public function responsableAction(){
        $em = $this->getDoctrine()->getManager();
        $dateDebut= new \DateTime();
        $dateDebut->modify('-2 day');
        $dateFin= new \DateTime();
         $dateFin->modify('-2 day');
        $ventilationsRetards = $em->getRepository("AppBundle:Ventilation")->findByNotValidationAndDateMax($dateFin);
        $ventilations = $em->getRepository("AppBundle:Ventilation")->findByNotValidationAndDateMin($dateDebut);
        $ventilationsArchives = $em->getRepository("AppBundle:Ventilation")->findByAllDateMax($dateFin);
        return $this->render('ventilation/responsable.html.twig', array(
            'ventilations' => $ventilations,
            'ventilationsRetards' => $ventilationsRetards,
            'ventilationsArchives' => $ventilationsArchives
        ));
    }

    /**
    * Creates a new ventilation entity.
    *
    * @Route("/validation/{id}", name="ventilation_validation")
    * @Method({"GET", "POST"})
    */
    public function validationAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $ventilation = $em->getRepository("AppBundle:Ventilation")->find($id);
        $ventilation->setValidation(true);
        $em->persist($ventilation);
        $em->flush();

        return $this->redirectToRoute("ventilation_responsable");
    }

    /**
     * Creates a new ventilation entity.
     *
     * @Route("/voir/{id}", name="ventilation_voir")
     * @Method({"GET", "POST"})
     */
    public function voirAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $ventilation = $em->getRepository('AppBundle:Ventilation')->find($id);
        $activites = $em->getRepository('AppBundle:Activite')->findBy(
            array("ventilation" => $id));
        $autreactivites = $em->getRepository('AppBundle:AutreActivite')->findBy(
            array("ventilation" => $id));
        $anomalies = $em->getRepository('AppBundle:Anomalies')->findBy(
            array("ventilation" => $id));

        $tempsActivite = 0;
        $tempsAutreActivite = 0;
        $tempsAnomalie = 0;

        foreach ($activites as $activite){
            $tempsActivite = $tempsActivite + $activite->getTemps();
        }
        foreach ($autreactivites as $autreActivite){
            $tempsAutreActivite = $tempsAutreActivite + $autreActivite->getTemps();
        }
        foreach ($anomalies as $anomalie){
            $tempsAnomalie = $tempsAnomalie + $anomalie->getTemps();
        }

        $tempsJournalier = $tempsActivite+$tempsAutreActivite+$tempsAnomalie;

        return $this->render('ventilation/voir.html.twig', array(
            "ventilation" => $ventilation,
            'activites'=> $activites,
            'autreActivites'=> $autreactivites,
            'anomalies' => $anomalies,
            'tempsActivite' => $tempsActivite,
            'tempsAutreActivite' => $tempsAutreActivite,
            'tempsAnomalie' => $tempsAnomalie,
            'tempsJournalier' => $tempsJournalier
        ));
    }

    /**
     * Creates a new ventilation entity.
     *
     * @Route("/new/{id}", name="ventilation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $activite = $em->getRepository("AppBundle:TypeActivite")->find($id);
        $formulaires = $em->getRepository('AppBundle:Formulaire')->findBy(array("type_activite" => $id));

        $user = $em->getRepository('AppBundle:Utilisateur')->find($this->getUser()->getId());

        $total = 0;

        $tempsPassee = $em->getRepository('AppBundle:Ventilation')->findAllTempsPasseeVentilation($user, $id);

        foreach ($tempsPassee as $temps) {
            $total = $total + $temps->getTempsPasse();
        }

        $ventilation = new Ventilation();

        $form = $this->createForm('AppBundle\Form\VentilationType', $ventilation);
        $form->handleRequest($request);

        /*$id_formulaire_modele = $request->get('formulaire');*

        // Si on vient de la selection du formulair e
        /*if ($id_formulaire_modele == null) {
            $id_formulaire_modele = $form->get('formulaire')->getData();
        } else {//Sinon on charge depuis le form
            $form->get('formulaire')->setData($id_formulaire_modele);
        }*/


        //On recupère le formulaire dans la base
        //$formulaire = $repo_formulaire_modele->find($id_formulaire_modele);

        //On récupère tout les elements du formulaire modele. 
        //$elements = $formulaire->getListeElements();

        /*$ventilationFormulaire = new \AppBundle\Entity\VentilationFormulaire();

        $listeElementsValorises = [];

        foreach ($elements as $element) {
            $elementsValorise = new \AppBundle\Entity\ElementsValorises();
            $elementsValorise->setElement($element);
            $elementsValorise->setVentilationFormulaire($ventilationFormulaire);
            $elementsValorise->setValeur($element->getValeur_default());
            $listeElementsValorises[] = $elementsValorise;
        }
        //var_dump($listeElementsValorises);
        $ventilationFormulaire->setElementsValorises($listeElementsValorises);
        $ventilationFormulaire->setFormulaire($formulaire);
        $ventilation->setVentilationFormulaire($ventilationFormulaire);*/
        /*$form = $this->createForm('AppBundle\Form\VentilationType', $ventilation);
 
        $form->get('formulaire')->setData($id_formulaire_modele);
        $form->handleRequest($request);*/
        if ($form->isSubmitted() && $form->isValid()) {
            $ventilation = $form->getData();
            $ventilation->setValidation(false);

            // GET USER ID FOS USER BUNDLE
            //$user = $this->container->get('security.context')->getToken()->getUser();

            $ventilation->setUtilisateur($user);

            //var_dump($num_formulaire);

            $form = $em->getRepository("AppBundle:Formulaire")->find($id);

            $ventilation->setFormulaire($form);

            $em->persist($ventilation);
            $ventilation->setDateSaisie(new \DateTime);
            $em->flush();

            return $this->redirectToRoute('ventilation_show', array('id' => $ventilation->getId()));
        }

        return $this->render('ventilation/new.html.twig', array(
                    'ventilation' => $ventilation,
                    'formulaires' => $formulaires,
                    'temps' => $total,
                    'form' => $form->createView(),
        ));
    }

}
