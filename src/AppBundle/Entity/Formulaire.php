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

    function getId() {
        return $this->id;
    }

    function getLibelle() {
        return $this->libelle;
    }

    function getListeElements() {
        return $this->listeElements;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLibelle($libelle) {
        $this->libelle = $libelle;
    }

    function setListeElements($listeElements) {
        $this->listeElements = $listeElements;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->listeElements = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add listeElement
     *
     * @param \AppBundle\Entity\Element $listeElement
     *
     * @return Formulaire
     */
    public function addListeElement(\AppBundle\Entity\Element $listeElement)
    {
        $this->listeElements[] = $listeElement;

        return $this;
    }

    /**
     * Remove listeElement
     *
     * @param \AppBundle\Entity\Element $listeElement
     */
    public function removeListeElement(\AppBundle\Entity\Element $listeElement)
    {
        $this->listeElements->removeElement($listeElement);
    }
}
