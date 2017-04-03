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
    private $nom;

    /** @ORM\Column(type="string") */
    private $prenom;

    /** @ORM\Column(type="boolean") */
    private $statut;

    /** @ORM\Column(type="integer") */
    private $identifiantIGE;

    /** @ORM\Column(type="boolean") */
    private $responsabe;

    /** @ORM\Column(type="string") */
    private $nbHeureTheoriqueSession;

    /** @ORM\Column(type="datetime") */
    private $dateCreation;
    
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

}
