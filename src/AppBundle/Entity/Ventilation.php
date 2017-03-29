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
     * @var \DateTime
     *
     * @ORM\Column(name="dateSaisie", type="datetime")
     */
    private $dateSaisie;
    
    /*
     * @ORM\ManyToOne(targetEntity="Poste")
     * @ORM\JoinColumn(name="poste", referencedColumnName="id")
     */
    private $poste;
    
    /*
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumn(name="utilisateur", referencedColumnName="id")
     */
    private $utilisateur;
    
    /*
     * @ORM\OneToOne(targetEntity="VentilationActivite")
     * @ORM\JoinColumn(name="ventilation_activite", referencedColumnName="id")
     */
    private $ventilationActivite;
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set tempsPasse
     *
     * @param integer $tempsPasse
     *
     * @return Ventilation
     */
    public function setTempsPasse($tempsPasse)
    {
        $this->tempsPasse = $tempsPasse;

        return $this;
    }

    /**
     * Get tempsPasse
     *
     * @return int
     */
    public function getTempsPasse()
    {
        return $this->tempsPasse;
    }

    /**
     * Set dateSaisie
     *
     * @param \DateTime $dateSaisie
     *
     * @return Ventilation
     */
    public function setDateSaisie($dateSaisie)
    {
        $this->dateSaisie = $dateSaisie;

        return $this;
    }

    /**
     * Get dateSaisie
     *
     * @return \DateTime
     */
    public function getDateSaisie()
    {
        return $this->dateSaisie;
    }
    
    function getPoste() {
        return $this->poste;
    }

    function getUtilisateur() {
        return $this->utilisateur;
    }

    function getVentilationActivite() {
        return $this->ventilationActivite;
    }

    function setPoste($poste) {
        $this->poste = $poste;
    }

    function setUtilisateur($utilisateur) {
        $this->utilisateur = $utilisateur;
    }

    function setVentilationActivite($ventilationActivite) {
        $this->ventilationActivite = $ventilationActivite;
    }
}

