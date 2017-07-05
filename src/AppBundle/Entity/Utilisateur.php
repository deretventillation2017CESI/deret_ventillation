<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Entity
 * @ORM\Table(name="utilisateur")
 */
class Utilisateur extends BaseUser {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct() {
        $this->poste = new ArrayCollection();
        parent::__construct();
        // your own logic
    }


    /** @ORM\Column(type="string") */
    protected $nom;

    /** @ORM\Column(type="string") */
    protected $prenom;

    /** @ORM\Column(type="boolean") */
    protected $statut;

    /** @ORM\Column(type="integer") */
    protected $identifiantIGE;

    /** @ORM\Column(type="boolean") */
    protected $responsable;

    /** @ORM\Column(type="string") */
    protected $nbHeureTheoriqueSession;

    /** @ORM\Column(type="datetime") */
    protected $dateCreation;
    
/*
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumn(name="responsableN1", referencedColumnName="id")
     */
    private $responsableN1;

    /**
     * un utilisateur à un contrat
     * @ORM\OneToOne(targetEntity="Contrat")
     * @ORM\JoinColumn(name="contrat_id", referencedColumnName="id")
     */
    private $contrat;

    /**
     * un utilisateur à une PlageHoraire
     * @ORM\OneToOne(targetEntity="PlageHoraire")
     * @ORM\JoinColumn(name="plage_horaire_id", referencedColumnName="id")
     */
    private $typeHoraire;

    /**
     * un utilisateur à un secteur
     * @ORM\OneToOne(targetEntity="Secteur")
     * @ORM\JoinColumn(name="secteur_id", referencedColumnName="id")
     */
    private $secteur;

    /**
     * un utilisateur à un batiment
     * @ORM\OneToOne(targetEntity="Batiment")
     * @ORM\JoinColumn(name="batiment_id", referencedColumnName="id")
     */
    private $batiment;


    /**
     * un utilisateur à un poste
     * @ORM\OneToOne(targetEntity="Poste")
     * @ORM\JoinColumn(name="poste_id", referencedColumnName="id")
     */
    private $poste;

     /*
     * @ORM\ManyToOne(targetEntity="Dossier")
     * @ORM\JoinColumn(name="dossier", referencedColumnName="id")
     */
    private $dossier;


    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Utilisateur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Utilisateur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set statut
     *
     * @param boolean $statut
     *
     * @return Utilisateur
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return boolean
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set identifiantIGE
     *
     * @param integer $identifiantIGE
     *
     * @return Utilisateur
     */
    public function setIdentifiantIGE($identifiantIGE)
    {
        $this->identifiantIGE = $identifiantIGE;

        return $this;
    }

    /**
     * Get identifiantIGE
     *
     * @return integer
     */
    public function getIdentifiantIGE()
    {
        return $this->identifiantIGE;
    }

    /**
     * Set responsable
     *
     * @param boolean $responsable
     *
     * @return Utilisateur
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return boolean
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set nbHeureTheoriqueSession
     *
     * @param string $nbHeureTheoriqueSession
     *
     * @return Utilisateur
     */
    public function setNbHeureTheoriqueSession($nbHeureTheoriqueSession)
    {
        $this->nbHeureTheoriqueSession = $nbHeureTheoriqueSession;

        return $this;
    }

    /**
     * Get nbHeureTheoriqueSession
     *
     * @return string
     */
    public function getNbHeureTheoriqueSession()
    {
        return $this->nbHeureTheoriqueSession;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return Utilisateur
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * @return mixed
     */
    public function getResponsableN1()
    {
        return $this->responsableN1;
    }

    /**
     * @param mixed $responsableN1
     */
    public function setResponsableN1($responsableN1)
    {
        $this->responsableN1 = $responsableN1;
    }

    /**
     * @return mixed
     */
    public function getContrat()
    {
        return $this->contrat;
    }

    /**
     * @param mixed $contrat
     */
    public function setContrat($contrat)
    {
        $this->contrat = $contrat;
    }

    /**
     * @return mixed
     */
    public function getTypeHoraire()
    {
        return $this->typeHoraire;
    }

    /**
     * @param mixed $typeHoraire
     */
    public function setTypeHoraire($typeHoraire)
    {
        $this->typeHoraire = $typeHoraire;
    }

    /**
     * @return mixed
     */
    public function getSecteur()
    {
        return $this->secteur;
    }

    /**
     * @param mixed $secteur
     */
    public function setSecteur($secteur)
    {
        $this->secteur = $secteur;
    }

    /**
     * @return mixed
     */
    public function getBatiment()
    {
        return $this->batiment;
    }

    /**
     * @param mixed $batiment
     */
    public function setBatiment($batiment)
    {
        $this->batiment = $batiment;
    }

    /**
     * @return mixed
     */
    public function getPoste()
    {
        return $this->poste;
    }

    /**
     * @param mixed $poste
     */
    public function setPoste($poste)
    {
        $this->poste = $poste;
    }

    /**
     * @return mixed
     */
    public function getDossier()
    {
        return $this->dossier;
    }

    /**
     * @param mixed $dossier
     */
    public function setDossier($dossier)
    {
        $this->dossier = $dossier;
    }


}
