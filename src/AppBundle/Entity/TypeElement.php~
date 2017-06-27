<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeElement
 *
 * @ORM\Table(name="type_element")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TypeElementRepository")
 */
class TypeElement {

    public static $TYPE_TEXT = 1;
    public static $TYPE_TEXTAREA = 2;
    public static $TYPE_NOMBRE = 3;
    public static $TYPE_CHECKBOX = 4;
    public static $TYPE_SELECT = 5;

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
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return TypeElement
     */
    public function setLibelle($libelle) {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle() {
        return $this->libelle;
    }

    function __toString() {
        return $this->getLibelle();
    }

}
