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
    *
    * @ORM\ManyToOne(targetEntity="Produit")
    * @ORM\JoinColumn(name="id_produit", referencedColumnName="id")
    */
    private $produit;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer")
     */
    private $quantite;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string", length=255 )
     */
    private $commentaire;

    /**
     * One Product has One Shipment.
     * @ORM\ManyToOne(targetEntity="Formulaire")
     * @ORM\JoinColumn(name="formulaire_id", referencedColumnName="id")
     */
    private $formulaire;
    
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

    /**
     * Set produit
     *
     * @param \AppBundle\Entity\Produit $produit
     *
     * @return Ventilation
     */
    public function setProduit(\AppBundle\Entity\Produit $produit = null)
    {
        $this->produit = $produit;

        return $this;
    }

    /**
     * Get produit
     *
     * @return \AppBundle\Entity\Produit
     */
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return Ventilation
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return integer
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Ventilation
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->formulaire = new \Doctrine\Common\Collections\ArrayCollection();
    }



    /**
     * Set formulaire
     *
     * @param \AppBundle\Entity\Formulaire $formulaire
     *
     * @return Ventilation
     */
    public function setFormulaire(\AppBundle\Entity\Formulaire $formulaire = null)
    {
        $this->formulaire = $formulaire;

        return $this;
    }

    /**
     * Get formulaire
     *
     * @return \AppBundle\Entity\Formulaire
     */
    public function getFormulaire()
    {
        return $this->formulaire;
    }
}
