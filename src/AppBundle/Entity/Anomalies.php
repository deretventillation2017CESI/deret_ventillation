<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Anomalies
 *
 * @ORM\Table(name="anomalies")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AnomaliesRepository")
 */
class Anomalies
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
     * @var string
     *
     * @ORM\Column(name="anomalie", type="string", length=255)
     */
    private $anomalie;

    /**
     * @var string
     *
     * @ORM\Column(name="type_produit", type="string", length=255)
     */
    private $typeProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="fabricant", type="string", length=255)
     */
    private $fabricant;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=255)
     */
    private $reference;

    /**
     * @var string
     *
     * @ORM\Column(name="code_defaut", type="string", length=255)
     */
    private $codeDefaut;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer")
     */
    private $quantite;

    /**
     * @var string
     *
     * @ORM\Column(name="temps", type="decimal", precision=5, scale=0)
     */
    private $temps;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string", length=255)
     */
    private $commentaire;

    /**
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumn(name="utilisateur", referencedColumnName="id")
     */
    private $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Ventilation", inversedBy="anomalies")
     * @ORM\JoinColumn(name="ventilation_id", referencedColumnName="id")
     */
    private $ventilation;

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
     * Set anomalie
     *
     * @param string $anomalie
     *
     * @return Anomalies
     */
    public function setAnomalie($anomalie)
    {
        $this->anomalie = $anomalie;

        return $this;
    }

    /**
     * Get anomalie
     *
     * @return string
     */
    public function getAnomalie()
    {
        return $this->anomalie;
    }

    /**
     * Set typeProduit
     *
     * @param string $typeProduit
     *
     * @return Anomalies
     */
    public function setTypeProduit($typeProduit)
    {
        $this->typeProduit = $typeProduit;

        return $this;
    }

    /**
     * Get typeProduit
     *
     * @return string
     */
    public function getTypeProduit()
    {
        return $this->typeProduit;
    }

    /**
     * Set fabricant
     *
     * @param string $fabricant
     *
     * @return Anomalies
     */
    public function setFabricant($fabricant)
    {
        $this->fabricant = $fabricant;

        return $this;
    }

    /**
     * Get fabricant
     *
     * @return string
     */
    public function getFabricant()
    {
        return $this->fabricant;
    }

    /**
     * Set reference
     *
     * @param string $reference
     *
     * @return Anomalies
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set codeDefaut
     *
     * @param string $codeDefaut
     *
     * @return Anomalies
     */
    public function setCodeDefaut($codeDefaut)
    {
        $this->codeDefaut = $codeDefaut;

        return $this;
    }

    /**
     * Get codeDefaut
     *
     * @return string
     */
    public function getCodeDefaut()
    {
        return $this->codeDefaut;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return Anomalies
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set temps
     *
     * @param string $temps
     *
     * @return Anomalies
     */
    public function setTemps($temps)
    {
        $this->temps = $temps;

        return $this;
    }

    /**
     * Get temps
     *
     * @return string
     */
    public function getTemps()
    {
        return $this->temps;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Anomalies
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Anomalies
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\Utilisateur $user
     *
     * @return Anomalies
     */
    public function setUser(\AppBundle\Entity\Utilisateur $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\Utilisateur
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set ventilation
     *
     * @param \AppBundle\Entity\Ventilation $ventilation
     *
     * @return Anomalies
     */
    public function setVentilation(\AppBundle\Entity\Ventilation $ventilation = null)
    {
        $this->ventilation = $ventilation;

        return $this;
    }

    /**
     * Get ventilation
     *
     * @return \AppBundle\Entity\Ventilation
     */
    public function getVentilation()
    {
        return $this->ventilation;
    }
}
