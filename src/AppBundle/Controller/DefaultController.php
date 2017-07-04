<?php

namespace AppBundle\Controller;

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
