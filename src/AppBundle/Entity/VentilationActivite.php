<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VentilationActivite
 *
 * @ORM\Table(name="ventilation_activite")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VentilationActiviteRepository")
 */
class VentilationActivite
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /*
     * @ORM\OneToOne(targetEntity="Ventilation", inversedBy="ventilationActivite")
     * @ORM\JoinColumn(name="ventilation", referencedColumnName="id")
     */
    private $ventilation;
    
    /*
     * @ORM\ManyToOne(targetEntity="Activite")
     * @ORM\JoinColumn(name="activite", referencedColumnName="id")
     */
    private $activite;
    
    /*
     * @ORM\ManyToMany(targetEntity="ElementsValorises")
     * @ORM\JoinTable(name="ventilation_activite_elements_valorises",
     *      joinColumns={@ORM\JoinColumn(name="ventilation_activite", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="elements_valorises", referencedColumnName="id", unique=true)}
     *      )
     */
    private $elementsValorises;
    
    
    /* Constructeur */
    function __construct() {
        $this->listeElement = new \Doctrine\Common\Collections\ArrayCollection();
    }

        /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    function getVentilation() {
        return $this->ventilation;
    }

    function getActivite() {
        return $this->activite;
    }

    function setVentilation($ventilation) {
        $this->ventilation = $ventilation;
    }

    function setActivite($activite) {
        $this->activite = $activite;
    }
    
    function getElementsValorises() {
        return $this->elementsValorises;
    }

    function setElementsValorises($elementsValorises) {
        $this->elementsValorises = $elementsValorises;
    }

}
