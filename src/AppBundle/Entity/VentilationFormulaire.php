<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VentilationFormulaire
 *
 * @ORM\Table(name="ventilation_formulaire")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VentilationFormulaireRepository")
 */
class VentilationFormulaire
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
     * @ORM\OneToOne(targetEntity="Ventilation", inversedBy="ventilationFormulaire")
     * @ORM\JoinColumn(name="ventilation", referencedColumnName="id")
     */
    private $ventilation;

    /*
     * @ORM\ManyToOne(targetEntity="Formulaire")
     * @ORM\JoinColumn(name="formulaire", referencedColumnName="id")
     */
    private $formulaire;


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
     * Set ventilation
     *
     * @param integer $ventilation
     *
     * @return VentilationFormulaire
     */
    public function setVentilation($ventilation)
    {
        $this->ventilation = $ventilation;

        return $this;
    }

    /**
     * Get ventilation
     *
     * @return int
     */
    public function getVentilation()
    {
        return $this->ventilation;
    }

    /**
     * Set formulaire
     *
     * @param integer $formulaire
     *
     * @return VentilationFormulaire
     */
    public function setFormulaire($formulaire)
    {
        $this->formulaire = $formulaire;

        return $this;
    }

    /**
     * Get formulaire
     *
     * @return int
     */
    public function getFormulaire()
    {
        return $this->formulaire;
    }
}

