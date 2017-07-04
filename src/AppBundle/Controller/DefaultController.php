<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Activite;
use AppBundle\Entity\Anomalies;
use AppBundle\Entity\AutreActivite;
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

            $em->persist($activite);
            $em->flush();

            return $this->redirectToRoute('ventilation_index');
        }
        return $this->render('activite/index.html.twig');
    }

    /**
     * @Route("autreactivite/", name="autreactivite")
     */
    public function indexAutreActiviteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('AppBundle:Utilisateur')->find($this->getUser()->getId());

        if($request->request->get("metier"))
        {
            $autreActivite = new AutreActivite();
            $autreActivite->setActivite($_POST['metier']);
            $autreActivite->setCommentaire($_POST['commentaire']);
            $autreActivite->setTemps($_POST['temps']);
            $autreActivite->setUser($user);
            $autreActivite->setDate(new \DateTime());

            $em->persist($autreActivite);
            $em->flush();

            return $this->redirectToRoute('ventilation_index');
        }

        return $this->render('autre_activite/index.html.twig');
    }

    /**
     * @Route("anomalie/", name="anomalie")
     */
    public function indexAnomalieAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('AppBundle:Utilisateur')->find($this->getUser()->getId());

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

            $em->persist($anomalie);
            $em->flush();

            return $this->redirectToRoute('ventilation_index');
        }

        return $this->render('anomalie/index.html.twig');
    }
}
