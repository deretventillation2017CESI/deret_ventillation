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
     * @var boolean
     *
     * @ORM\Column(name="validation", type="boolean")
     */
    private $validation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateSaisie", type="date")
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Activite", mappedBy="ventilation")
     */
    private $activites;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\AutreActivite", mappedBy="ventilation")
     */
    private $autreactivite;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Anomalies", mappedBy="ventilation")
     */
    private $anomalies;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set validation
     *
     * @param boolean $validation
     *
     * @return Ventilation
     */
    public function setValidation($validation)
    {
        $this->validation = $validation;

        return $this;
    }

    /**
     * Get validation
     *
     * @return boolean
     */
    public function getValidation()
    {
        return $this->validation;
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

    /**
     * Set poste
     *
     * @param \AppBundle\Entity\Poste $poste
     *
     * @return Ventilation
     */
    public function setPoste(\AppBundle\Entity\Poste $poste = null)
    {
        $this->poste = $poste;

        return $this;
    }

    /**
     * Get poste
     *
     * @return \AppBundle\Entity\Poste
     */
    public function getPoste()
    {
        return $this->poste;
    }

    /**
     * Set utilisateur
     *
     * @param \AppBundle\Entity\Utilisateur $utilisateur
     *
     * @return Ventilation
     */
    public function setUtilisateur(\AppBundle\Entity\Utilisateur $utilisateur = null)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \AppBundle\Entity\Utilisateur
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->activites = new \Doctrine\Common\Collections\ArrayCollection();
        $this->autreactivite = new \Doctrine\Common\Collections\ArrayCollection();
        $this->anomalies = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add activite
     *
     * @param \AppBundle\Entity\Activite $activite
     *
     * @return Ventilation
     */
    public function addActivite(\AppBundle\Entity\Activite $activite)
    {
        $this->activites[] = $activite;

        return $this;
    }

    /**
     * Remove activite
     *
     * @param \AppBundle\Entity\Activite $activite
     */
    public function removeActivite(\AppBundle\Entity\Activite $activite)
    {
        $this->activites->removeElement($activite);
    }

    /**
     * Get activites
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActivites()
    {
        return $this->activites;
    }

    /**
     * Add autreactivite
     *
     * @param \AppBundle\Entity\AutreActivite $autreactivite
     *
     * @return Ventilation
     */
    public function addAutreactivite(\AppBundle\Entity\AutreActivite $autreactivite)
    {
        $this->autreactivite[] = $autreactivite;

        return $this;
    }

    /**
     * Remove autreactivite
     *
     * @param \AppBundle\Entity\AutreActivite $autreactivite
     */
    public function removeAutreactivite(\AppBundle\Entity\AutreActivite $autreactivite)
    {
        $this->autreactivite->removeElement($autreactivite);
    }

    /**
     * Get autreactivite
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAutreactivite()
    {
        return $this->autreactivite;
    }

    /**
     * Add anomaly
     *
     * @param \AppBundle\Entity\Anomalies $anomaly
     *
     * @return Ventilation
     */
    public function addAnomaly(\AppBundle\Entity\Anomalies $anomaly)
    {
        $this->anomalies[] = $anomaly;

        return $this;
    }

    /**
     * Remove anomaly
     *
     * @param \AppBundle\Entity\Anomalies $anomaly
     */
    public function removeAnomaly(\AppBundle\Entity\Anomalies $anomaly)
    {
        $this->anomalies->removeElement($anomaly);
    }

    /**
     * Get anomalies
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnomalies()
    {
        return $this->anomalies;
    }
}
