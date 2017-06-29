<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ventilation
 *
 * @ORM\Table(name="ventilation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VentilationRepository")
 */
class Ventilation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="tempsPasse", type="integer")
     */
    private $tempsPasse;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="validation", type="boolean")
     */
    private $validation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateSaisie", type="datetime")
     */
    private $dateSaisie;
    
    /**
     * @ORM\ManyToOne(targetEntity="Poste")
     * @ORM\JoinColumn(name="poste", referencedColumnName="id")
     */
    private $poste;
    
    /**
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumn(name="utilisateur", referencedColumnName="id")
     */
    private $utilisateur;
    
    /**
     * @ORM\OneToOne(targetEntity="VentilationFormulaire", mappedBy="ventilation" , cascade={"persist"})
     */
    private $ventilationFormulaire;
    
    function getId() {
        return $this->id;
    }

    function getTempsPasse() {
        return $this->tempsPasse;
    }

    function getValidation() {
        return $this->validation;
    }

    function getDateSaisie() {
        return $this->dateSaisie;
    }

    function getPoste() {
        return $this->poste;
    }

    function getUtilisateur() {
        return $this->utilisateur;
    }

    function getVentilationFormulaire() {
        return $this->ventilationFormulaire;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTempsPasse($tempsPasse) {
        $this->tempsPasse = $tempsPasse;
    }

    function setValidation($validation) {
        $this->validation = $validation;
    }

    function setDateSaisie(\DateTime $dateSaisie) {
        $this->dateSaisie = $dateSaisie;
    }

    function setPoste($poste) {
        $this->poste = $poste;
    }

    function setUtilisateur($utilisateur) {
        $this->utilisateur = $utilisateur;
    }

    function setVentilationFormulaire($ventilationFormulaire) {   
        $ventilationFormulaire->setVentilation($this);
        $this->ventilationFormulaire = $ventilationFormulaire;
     
    }


}
