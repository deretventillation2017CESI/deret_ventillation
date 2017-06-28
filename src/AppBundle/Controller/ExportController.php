<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use \DateTime;

class ExportController extends Controller
{
    /**
     * @Route("Export/index", name="export_index")
     */
    public function indexAction(Request $request)
    {
        $date_debut = new DateTime($request->request->get('date_debut'));
        $date_fin = new DateTime($request->request->get('date_fin'));
        $tab_heure_total = [];
        
        if (!empty($date_debut) && !empty($date_fin)) 
        {
            $em = $this->getDoctrine()->getManager();
            $allVentilation = $em->getRepository('AppBundle:Ventilation')->findVentilationCreatedBetweenTwoDates($date_debut, $date_fin);
            foreach ($allVentilation as $ventilation) {
                $tab_heure_total[$ventilation->getVentilationFormulaire()->getFormulaire()->getLibelle()] += $ventilation->getTempsPasse();
            }
        }
        
        return $this->render('export/index.html.twig', array(
            "tabHeureTotal" => $tab_heure_total
        ));
    }

}
