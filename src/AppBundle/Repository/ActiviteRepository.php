<?php

namespace AppBundle\Repository;

/**
 * ActiviteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ActiviteRepository extends \Doctrine\ORM\EntityRepository
{
    /*
     * FONCTION : Récupère toutes les activités entre 2 dates
     */
    public function findVentilationCreatedBetweenTwoDates(\DateTime $date_debut, \DateTime $date_fin)
    {
//        return $this->createQueryBuilder('m')
//                    ->join('m.ventilationFormulaire', 'vf')
//                    ->join('vf.formulaire', 'f')
//                    ->where("m.dateSaisie > ?1")
//                    ->andWhere("m.dateSaisie < ?2")
//                    ->orderBy('f.libelle', 'ASC')
//                    ->setParameter(1, $date_debut)
//                    ->setParameter(2, $date_fin)
//                    ->getQuery()
//                    ->getResult();
    }
}
