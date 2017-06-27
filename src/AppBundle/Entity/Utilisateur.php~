<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

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
    protected $responsabe;

    /** @ORM\Column(type="string") */
    protected $nbHeureTheoriqueSession;

    /** @ORM\Column(type="datetime") */
    protected $dateCreation;
    
/*
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumn(name="responsableN1", referencedColumnName="id")
     */
    private $responsableN1;
    /*
     * @ORM\ManyToOne(targetEntity="TypeContrat")
     * @ORM\JoinColumn(name="type_contrat", referencedColumnName="id")
     */
    private $typeContrat;

    /*
     * @ORM\ManyToOne(targetEntity="TypeHoraire")
     * @ORM\JoinColumn(name="type_horaire", referencedColumnName="id")
     */
    private $typeHoraire;

    /* @ORM\ManyToMany(targetEntity="Secteur")
     * @ORM\JoinTable(name="utilisateur_secteur",
     *      joinColumns={@JoinColumn(name="id_utilisateur", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="id_secteur", referencedColumnName="id")}
     *      )
     */
    private $secteur;

     /* @ORM\ManyToMany(targetEntity="Batiment")
     * @ORM\JoinTable(name="utilisateur_batiment",
     *      joinColumns={@JoinColumn(name="id_utilisateur", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="id_batiment", referencedColumnName="id")}
     *      )
     */
    private $batiment;

    /* @ORM\ManyToMany(targetEntity="Poste")
     * @ORM\JoinTable(name="utilisateur_poste",
     *      joinColumns={@JoinColumn(name="id_utilisateur", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="id_poste", referencedColumnName="id")}
     *      )
     */
    private $poste;

     /*
     * @ORM\ManyToOne(targetEntity="Dossier")
     * @ORM\JoinColumn(name="dosier", referencedColumnName="id")
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
     * Set responsabe
     *
     * @param boolean $responsabe
     *
     * @return Utilisateur
     */
    public function setResponsabe($responsabe)
    {
        $this->responsabe = $responsabe;

        return $this;
    }

    /**
     * Get responsabe
     *
     * @return boolean
     */
    public function getResponsabe()
    {
        return $this->responsabe;
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
}
