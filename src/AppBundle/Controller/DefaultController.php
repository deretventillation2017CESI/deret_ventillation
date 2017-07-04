<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Activite;
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

        if($request->request->get("metier"))
        {
            $activite = new Activite();
            $activite->setMetier($_POST['metier']);
            $activite->setCommentaire($_POST['commentaire']);
            $activite->setQuantite($_POST['quantite']);
            $activite->setTemps($_POST['temps']);
            $activite->setTypeProduit(($_POST['typeProduit']));

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

        return $this->render('activite/index.html.twig');
    }

    /**
     * @Route("anomalie/", name="anomalie")
     */
    public function indexAnomalieAction(Request $request)
    {

        return $this->render('activite/index.html.twig');
    }
}
