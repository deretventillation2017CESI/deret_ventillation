<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Activite;
use AppBundle\Entity\Anomalies;
use AppBundle\Entity\AutreActivite;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
 
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("activite/", name="activite")
     */
    public function indexActiviteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('AppBundle:Utilisateur')->find($this->getUser()->getId());
        $ventilation = $em->getRepository('AppBundle:Ventilation')->findBy(array(
            'utilisateur' => $user,
            'dateSaisie' => new \DateTime()
        ));

        if($request->request->get("metier"))
        {
            $activite = new Activite();
            $activite->setMetier($_POST['metier']);
            $activite->setCommentaire($_POST['commentaire']);
            $activite->setQuantite($_POST['quantite']);
            $activite->setTemps($_POST['temps']);
            $activite->setTypeProduit(($_POST['typeProduit']));
            $activite->setUser($user);
            $activite->setDate(new \DateTime());
            $activite->setVentilation($ventilation[0]);

            $em->persist($activite);
            $em->flush();

            return $this->redirectToRoute('ventilation_index');
        }
        return $this->render('activite/index.html.twig');
    }

    /**
     * @Route("activite/{id}/edit", name="activite_edit")
     * @Method({"GET", "POST"})
     */
    public function editActiviteAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();

        $activite = $em->getRepository("AppBundle:Activite")->find($id);

        if($request->request->get("metier"))
        {
            $activite->setMetier($_POST['metier']);
            $activite->setCommentaire($_POST['commentaire']);
            $activite->setQuantite($_POST['quantite']);
            $activite->setTemps($_POST['temps']);
            $activite->setTypeProduit(($_POST['typeProduit']));


            $em->persist($activite);
            $em->flush();

            return $this->redirectToRoute('ventilation_index');
        }
        return $this->render('activite/edit.html.twig', array(
            'activite' => $activite
        ));
    }

    /**
     * @Route("{idVentilation}/activite/{id}/delete/resp", name="activite_delete_responsable")
     */
    public function deleteActiviteByResponsableAction($idVentilation, $id){
        $em = $this->getDoctrine()->getManager();
        $activite = $em->getRepository("AppBundle:Activite")->find($id);

        $em->remove($activite);
        $em->flush();

        return $this->redirectToRoute("ventilation_voir",array('id' => $idVentilation));
    }

    /**
     * @Route("{idVentilation}/activite/{id}/delete", name="activite_delete")
     */
    public function deleteActiviteAction($idVentilation, $id){
        $em = $this->getDoctrine()->getManager();
        $activite = $em->getRepository("AppBundle:Activite")->find($id);

        $em->remove($activite);
        $em->flush();

        return $this->redirectToRoute("ventilation_index");
    }

    /**
     * @Route("autreactivite/", name="autreactivite")
     */
    public function indexAutreActiviteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('AppBundle:Utilisateur')->find($this->getUser()->getId());
        $ventilation = $em->getRepository('AppBundle:Ventilation')->findBy(array(
            'utilisateur' => $user,
            'dateSaisie' => new \DateTime()
        ));

        if($request->request->get("metier"))
        {
            $autreActivite = new AutreActivite();
            $autreActivite->setActivite($_POST['metier']);
            $autreActivite->setCommentaire($_POST['commentaire']);
            $autreActivite->setTemps($_POST['temps']);
            $autreActivite->setUser($user);
            $autreActivite->setDate(new \DateTime());
            $autreActivite->setVentilation($ventilation[0]);

            $em->persist($autreActivite);
            $em->flush();

            return $this->redirectToRoute('ventilation_index');
        }

        return $this->render('autre_activite/index.html.twig');
    }

    /**
     * @Route("autreactivite/{id}/edit", name="autreactivite_edit")
     * @Method({"GET", "POST"})
     */
    public function editAutreActiviteAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();

        $autreActivite = $em->getRepository("AppBundle:AutreActivite")->find($id);

        if($request->request->get("metier"))
        {
            $autreActivite->setActivite($_POST['metier']);
            $autreActivite->setCommentaire($_POST['commentaire']);
            $autreActivite->setTemps($_POST['temps']);

            $em->persist($autreActivite);
            $em->flush();

            return $this->redirectToRoute('ventilation_index');
        }
        return $this->render('autre_activite/edit.html.twig', array(
            'autreActivite' => $autreActivite
        ));
    }

    /**
     * @Route("{idVentilation}/autreactivite/{id}/delete/resp", name="autreactivite_delete_responsable")
     */
    public function deleteAutreActiviteByResponsableAction($idVentilation, $id){
        $em = $this->getDoctrine()->getManager();
        $autreactivite = $em->getRepository("AppBundle:AutreActivite")->find($id);

        $em->remove($autreactivite);
        $em->flush();

        return $this->redirectToRoute("ventilation_voir",array('id' => $idVentilation));
    }

    /**
     * @Route("{idVentilation}/autreactivite/{id}/delete", name="autreactivite_delete")
     */
    public function deleteAutreActiviteAction($idVentilation, $id){
        $em = $this->getDoctrine()->getManager();
        $autreactivite = $em->getRepository("AppBundle:AutreActivite")->find($id);

        $em->remove($autreactivite);
        $em->flush();

        return $this->redirectToRoute("ventilation_index");
    }

    /**
     * @Route("anomalie/", name="anomalie")
     */
    public function indexAnomalieAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('AppBundle:Utilisateur')->find($this->getUser()->getId());
        $ventilation = $em->getRepository('AppBundle:Ventilation')->findBy(array(
            'utilisateur' => $user,
            'dateSaisie' => new \DateTime()
        ));

        if($request->request->get("metier"))
        {
            $anomalie = new Anomalies();
            $anomalie->setAnomalie($_POST['metier']);
            $anomalie->setCommentaire($_POST['commentaire']);
            $anomalie->setTemps($_POST['temps']);
            $anomalie->setTypeProduit($_POST['typeProduit']);
            $anomalie->setQuantite($_POST['quantite']);
            $anomalie->setCodeDefaut($_POST['code']);
            $anomalie->setFabricant($_POST['fabricant']);
            $anomalie->setReference($_POST['reference']);
            $anomalie->setUser($user);
            $anomalie->setDate(new \DateTime());
            $anomalie->setVentilation($ventilation[0]);

            $em->persist($anomalie);
            $em->flush();

            return $this->redirectToRoute('ventilation_index');
        }

        return $this->render('anomalie/index.html.twig');
    }

    /**
     * @Route("anomalie/{id}/edit", name="anomalie_edit")
     * @Method({"GET", "POST"})
     */
    public function editAnomalieAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();

        $anomalie = $em->getRepository("AppBundle:Anomalies")->find($id);

        if($request->request->get("metier"))
        {
            $anomalie->setAnomalie($_POST['metier']);
            $anomalie->setCommentaire($_POST['commentaire']);
            $anomalie->setTemps($_POST['temps']);
            $anomalie->setTypeProduit($_POST['typeProduit']);
            $anomalie->setQuantite($_POST['quantite']);
            $anomalie->setCodeDefaut($_POST['code']);
            $anomalie->setFabricant($_POST['fabricant']);
            $anomalie->setReference($_POST['reference']);

            $em->persist($anomalie);
            $em->flush();

            return $this->redirectToRoute('ventilation_index');
        }
        return $this->render('anomalie/edit.html.twig', array(
            'anomalie' => $anomalie
        ));
    }

    /**
    * @Route("{idVentilation}/anomalie/{id}/delete/resp", name="anomalie_delete_responsable")
    */
    public function deleteAnomalieByResponsableAction($idVentilation, $id){
        $em = $this->getDoctrine()->getManager();
        $anomalie = $em->getRepository("AppBundle:Anomalies")->find($id);

        $em->remove($anomalie);
        $em->flush();

        return $this->redirectToRoute("ventilation_voir",array('id' => $idVentilation));
    }

    /**
     * @Route("{idVentilation}/anomalie/{id}/delete", name="anomalie_delete")
     */
    public function deleteAnomalieAction($idVentilation, $id){
        $em = $this->getDoctrine()->getManager();
        $anomalie = $em->getRepository("AppBundle:Anomalies")->find($id);

        $em->remove($anomalie);
        $em->flush();

        return $this->redirectToRoute("ventilation_index");
    }
}
