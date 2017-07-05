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
        
        if (!empty($date_debut) && !empty($date_fin)) 
        {
            $em = $this->getDoctrine()->getManager();
            
            $tab_heure_activite = [];
            $allActivite = $em->getRepository('AppBundle:Activite')->findActiviteCreatedBetweenTwoDates($date_debut, $date_fin);
            foreach ($allActivite as $activite) {
                if (empty($tab_heure_activite[$activite->getMetier()])) {
                    $tab_heure_activite[$activite->getMetier()] = $activite->getTemps();
                } else {
                    $tab_heure_activite[$activite->getMetier()] += $activite->getTemps();
                }
            }
            
            $tab_heure_anomalie = [];
            $allAnomalie = $em->getRepository('AppBundle:Anomalies')->findAnomalieCreatedBetweenTwoDates($date_debut, $date_fin);
            foreach ($allAnomalie as $anomalie) {
                if (empty($tab_heure_anomalie[$anomalie->getAnomalie()])) {
                    $tab_heure_anomalie[$anomalie->getAnomalie()] = $anomalie->getTemps();
                } else {
                    $tab_heure_anomalie[$anomalie->getAnomalie()] += $anomalie->getTemps();
                }
            }
            
            $tab_heure_autres_activites = [];
            $allAutresActivites = $em->getRepository('AppBundle:AutreActivite')->findAutreActiviteCreatedBetweenTwoDates($date_debut, $date_fin);
            foreach ($allAutresActivites as $autres_activites) {
                if (empty($tab_heure_autres_activites[$autres_activites->getActivite()])) {
                    $tab_heure_autres_activites[$autres_activites->getActivite()] = $autres_activites->getTemps();
                } else {
                    $tab_heure_autres_activites[$autres_activites->getActivite()] += $autres_activites->getTemps();
                }
            }
        }
        
        return $this->render('export/index.html.twig', array(
            "tabHeureActivite" => $tab_heure_activite,
            "tabHeureAnomalie" => $tab_heure_anomalie,
            "tabHeureAutresActivites" => $tab_heure_autres_activites
        ));
    }

}
