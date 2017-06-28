<?php

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * ElementsValorises
 *
 * @ORM\Table(name="elements_valorises")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ElementsValorisesRepository")
 */
class ElementsValorises
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
     * @ORM\Column(name="valeur", type="string", length=255)
     */
    private $valeur;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="Element" , inversedBy="elementsValorises")
     * @ORM\JoinColumn(name="id_element", referencedColumnName="id")
     */
    private $element;
    
    /*
     * @var int
     */
    private $id_donnee_client;
    
    /**
     * @ORM\ManyToOne(targetEntity="VentilationFormulaire", inversedBy="elementsValorises")
     * @ORM\JoinColumn(name="id_ventilation_formulaire", referencedColumnName="id")
     */
    private $ventilationFormulaire;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->elements = new ArrayCollection();
    }

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
     * Set valeur
     *
     * @param string $valeur
     *
     * @return ElementsValorises
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;

        return $this;
    }

    /**
     * Get valeur
     *
     * @return string
     */
    public function getValeur()
    {
        return $this->valeur;
    }


    /**
     * Set ventilationFormulaire
     *
     * @param \AppBundle\Entity\VentilationFormulaire $ventilationFormulaire
     *
     * @return ElementsValorises
     */
    public function setVentilationFormulaire(\AppBundle\Entity\VentilationFormulaire $ventilationFormulaire = null)
    {
        $this->ventilationFormulaire = $ventilationFormulaire;

        return $this;
    }

    /**
     * Get ventilationFormulaire
     *
     * @return \AppBundle\Entity\VentilationFormulaire
     */
    public function getVentilationFormulaire()
    {
        return $this->ventilationFormulaire;
    }
    function getElement() {
        return $this->element;
    }

    function setElement($element) {
        $this->element = $element;
    }
 function getInput($form) {

     return $this->element->getInput($form);
 }
}
