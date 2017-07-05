<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use \DateTime;

class ExportController extends Controller
{
    /**
     * @Route("Export/index", name="export_index")
     */
    public function indexAction(Request $request)
    {
        return $this->render('export/index.html.twig');
    }
    
    
    
    
    /**
     * @Route("Export/download", name="export_download")
     */
    public function downloadAction(Request $request)
    {
        $date_debut = new DateTime($request->request->get('date_debut'));
        $date_fin = new DateTime($request->request->get('date_fin'));
        
        if (!empty($date_debut) && !empty($date_fin)) 
        {
            $filename = "export.csv";
            $delimiter = ';';
            $enclosure = '"';
            
            $response = new StreamedResponse();
            $response->setCallback(function() 
            {
                $em = $this->getDoctrine()->getManager();
                $handle = fopen('php://output', 'w+');

                fputcsv($handle, array('Activités'), $delimiter, $enclosure);
                fputcsv($handle, array('Métier', 'Nombre d\'heures'), $delimiter, $enclosure);
                $tab_heure_activite = [];
                $allActivite = $em->getRepository('AppBundle:Activite')->findActiviteCreatedBetweenTwoDates($date_debut, $date_fin);
                foreach ($allActivite as $activite) {
                        if (empty($tab_heure_activite[$activite->getMetier()])) {
                            $tab_heure_activite[$activite->getMetier()] = $activite->getTemps();
                        } else {
                            $tab_heure_activite[$activite->getMetier()] += $activite->getTemps();
                        }
                }
                foreach ($tab_heure_activite as $key => $value) {
                    fputcsv($handle, array($key, $value), $delimiter, $enclosure);
                }

                fputcsv($handle, array('Anomalies'), $delimiter, $enclosure);
                fputcsv($handle, array('Libelle', 'Nombre d\'heures'), $delimiter, $enclosure);
                $tab_heure_anomalie = [];
                $allAnomalie = $em->getRepository('AppBundle:Anomalies')->findAnomalieCreatedBetweenTwoDates($date_debut, $date_fin);
                foreach ($allAnomalie as $anomalie) {
                        if (empty($tab_heure_anomalie[$anomalie->getAnomalie()])) {
                            $tab_heure_anomalie[$anomalie->getAnomalie()] = $anomalie->getTemps();
                        } else {
                            $tab_heure_anomalie[$anomalie->getAnomalie()] += $anomalie->getTemps();
                        }
                }
                foreach ($tab_heure_anomalie as $key => $value) {
                    fputcsv($handle, array($key, $value), $delimiter, $enclosure);
                }

                fputcsv($handle, array('Autres activités'), $delimiter, $enclosure);
                fputcsv($handle, array('Activité', 'Nombre d\'heures'), $delimiter, $enclosure);
                $tab_heure_autres_activites = [];
                $allAutresActivites = $em->getRepository('AppBundle:AutreActivite')->findAutreActiviteCreatedBetweenTwoDates($date_debut, $date_fin);
                foreach ($allAutresActivites as $autres_activites) {
                        if (empty($tab_heure_autres_activites[$autres_activites->getActivite()])) {
                            $tab_heure_autres_activites[$autres_activites->getActivite()] = $autres_activites->getTemps();
                        } else {
                            $tab_heure_autres_activites[$autres_activites->getActivite()] += $autres_activites->getTemps();
                        }
                }
                foreach ($tab_heure_autres_activites as $key => $value) {
                    fputcsv($handle, array($key, $value), $delimiter, $enclosure);
                }

                fclose($handle);
            });
            
            $response->headers->set('Content-type', 'application/octect-stream');
            $response->headers->set('Content-Disposition', sprintf('attachment; filename="%s"', $filename));
            $response->headers->set('Content-Length', filesize($filename));
            $response->headers->set('Content-Transfer-Encoding', 'binary');
            $response->setContent(readfile($filename));

            return $response;
        }
    }
    

}
