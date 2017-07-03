<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Ventilation;
use AppBundle\Entity\Formulaire;
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

        $ventilations = $em->getRepository('AppBundle:Ventilation')->findAll();
        $formulaires = $em->getRepository('AppBundle:Formulaire')->findAll();
        $typeActivite = $em->getRepository('AppBundle:TypeActivite')->findAll();

        var_dump($request->request->get('typeActivite'));

        if($request->request->get('typeActivite')){
            return $this->redirectToRoute('ventilation_new', array('id' => $request->request->get('typeActivite')));
        }

        return $this->render('ventilation/index.html.twig', array(
                    'ventilations' => $ventilations,
                    'formulaires' => $formulaires,
                    'typeActivite' => $typeActivite
        ));
    }

    /**
     * Creates a new ventilation entity.
     *
     * @Route("/new/{id}", name="ventilation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $repo_formulaire_modele = $em->getRepository('AppBundle:Formulaire');

        $user = $em->getRepository('AppBundle:Utilisateur')->find($this->getUser()->getId());

        $total = 0;

        if(isset($_POST['formulaire'])) {
            setcookie("form", $_POST['formulaire']);

            var_dump("user".$user."cookieform".$_COOKIE['form']);

            $tempsPassee = $em->getRepository('AppBundle:Ventilation')->findAllTempsPasseeVentilation($user, $_COOKIE["form"]);

            foreach ($tempsPassee as $temps) {
                $total = $total + $temps->getTempsPasse();
            }
        }

        $ventilation = new Ventilation();

        $form = $this->createForm('AppBundle\Form\VentilationType', $ventilation);
        $form->handleRequest($request);

        $id_formulaire_modele = $request->get('formulaire');

        // Si on vient de la selection du formulair e
        if ($id_formulaire_modele == null) {
            $id_formulaire_modele = $form->get('formulaire')->getData();
        } else {//Sinon on charge depuis le form
            $form->get('formulaire')->setData($id_formulaire_modele);
        }


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
        $form = $this->createForm('AppBundle\Form\VentilationType', $ventilation);
 
        $form->get('formulaire')->setData($id_formulaire_modele);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $ventilation = $form->getData();
            $ventilation->setValidation(false);

            // GET USER ID FOS USER BUNDLE
            //$user = $this->container->get('security.context')->getToken()->getUser();

            $ventilation->setUtilisateur($user);

            //var_dump($num_formulaire);

            $form = $em->getRepository("AppBundle:Formulaire")->find($_COOKIE["form"]);

            $ventilation->setFormulaire($form);

            $em->persist($ventilation);
            $ventilation->setDateSaisie(new \DateTime);
            $em->flush();

            return $this->redirectToRoute('ventilation_show', array('id' => $ventilation->getId()));
        }

        return $this->render('ventilation/new.html.twig', array(
                    'ventilation' => $ventilation,
                    'temps' => $total,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ventilation entity.
     *
     * @Route("/{id}", name="ventilation_show")
     * @Method("GET")
     */
    public function showAction(Ventilation $ventilation) {
        $deleteForm = $this->createDeleteForm($ventilation);

        return $this->render('ventilation/show.html.twig', array(
                    'ventilation' => $ventilation,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ventilation entity.
     *
     * @Route("/{id}/edit", name="ventilation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Ventilation $ventilation) {
        $deleteForm = $this->createDeleteForm($ventilation);
        $editForm = $this->createForm('AppBundle\Form\VentilationType', $ventilation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ventilation_edit', array('id' => $ventilation->getId()));
        }

        return $this->render('ventilation/edit.html.twig', array(
                    'ventilation' => $ventilation,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ventilation entity.
     *
     * @Route("/{id}", name="ventilation_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Ventilation $ventilation) {
        $form = $this->createDeleteForm($ventilation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ventilation);
            $em->flush();
        }

        return $this->redirectToRoute('ventilation_index');
    }

    /**
     * Creates a form to delete a ventilation entity.
     *
     * @param Ventilation $ventilation The ventilation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Ventilation $ventilation) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('ventilation_delete', array('id' => $ventilation->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
