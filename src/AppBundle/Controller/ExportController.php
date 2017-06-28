<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ExportController extends Controller
{
    /**
     * @Route("Export/index", name="export_index")
     */
    public function indexAction(Request $request)
    {
        $date_debut = $request->request->get('date_debut');
        $date_fin = $request->request->get('date_fin');
        
        if (!empty($date_debut) && !empty($date_fin)) 
        {
            $em = $this->getDoctrine()->getManager();
            $allVentilation = $em->getRepository('AppBundle:Ventilation')->findVentilationCreatedBetweenTwoDates($date_debut, $date_fin);
            
            foreach ($allVentilation as $ventilation) {
                echo $ventilation->to_string();
            }
        }
        
        return $this->render('export/index.html.twig', array(
            // ...
        ));
    }

}
