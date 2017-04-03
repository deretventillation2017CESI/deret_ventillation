<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Formulaire
 *
 * @ORM\Table(name="formulaire")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FormulaireRepository")
 */
class Formulaire
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
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * Many Users have Many Groups.
     * @ORM\ManyToMany(targetEntity="Element")
     * @ORM\JoinTable(name="formulaire_elements",
     *      joinColumns={@ORM\JoinColumn(name="id_formulaire", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_element", referencedColumnName="id")}
     *      )
     */
    private $listeElements;


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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Formulaire
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set listeElements
     *
     * @param string $listeElements
     *
     * @return Formulaire
     */
    public function setListeElements($listeElements)
    {
        $this->listeElements = $listeElements;

        return $this;
    }

    /**
     * Get listeElements
     *
     * @return string
     */
    public function getListeElements()
    {
        return $this->listeElements;
    }
}

