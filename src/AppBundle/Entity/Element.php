<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * Element
 *
 * @ORM\Table(name="element")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ElementRepository")
 */
class Element {

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
     * @ORM\Column(name="libelle", type="string", length=100)
     */
    private $libelle;

    /**
     * @var bool
     *
     * @ORM\Column(name="obligatoire", type="boolean")
     */
    private $obligatoire;

    /*
     * @var string
     *
     * @ORM\Column(name="$valeur_default", type="string", length=100) 
     */
    private $valeur_default;

    /**
     * @ORM\ManyToOne(targetEntity="TypeElement")
     * @ORM\JoinColumn(name="id_typeElement", referencedColumnName="id")
     */
    private $typeElement;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToOne(targetEntity="ElementsValorises", inversedBy="elements")
     * @ORM\JoinColumn(name="id_elements_valorises", referencedColumnName="id")
     */
    private $elementsValorises;

    /**
     * Many Features have One Product.
     * @ORM\OneToMany(targetEntity="DonneeClientElement", mappedBy="element")
     */
    private $donneesClientElements;

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
     * @return Element
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

    /**
     * Set obligatoire
     *
     * @param boolean $obligatoire
     *
     * @return Element
     */
    public function setObligatoire($obligatoire) {
        $this->obligatoire = $obligatoire;

        return $this;
    }

    /**
     * Get obligatoire
     *
     * @return bool
     */
    public function getObligatoire() {
        return $this->obligatoire;
    }

    /**
     * Set typeElement
     *
     * @param \AppBundle\Entity\TypeElement $typeElement
     *
     * @return Element
     */
    public function setTypeElement(\AppBundle\Entity\TypeElement $typeElement = null) {
        $this->typeElement = $typeElement;

        return $this;
    }

    /**
     * Get typeElement
     *
     * @return \AppBundle\Entity\typeElement
     */
    public function getTypeElement() {
        return $this->typeElement;
    }

    function getElementsValorises() {
        return $this->elementsValorises;
    }

    function setElementsValorises(ArrayCollection $elementsValorises) {
        $this->elementsValorises = $elementsValorises;
    }

    function getValeur_default() {
        return $this->valeur_default;
    }

    function setValeur_default($valeur_default) {
        $this->valeur_default = $valeur_default;
    }

    function getDonneesClientElements() {
        return $this->donneesClientElements;
    }

    function getInput(\Symfony\Component\Form\Test\FormBuilderInterface $form) {
        $properties = array(
            'label' => $this->getLibelle(),
            'required' => $this->getObligatoire(),
            'data' => $this->getValeur_default(),
            'mapped'=>false
        );
        if ($this->getTypeElement()->getId() == TypeElement::$TYPE_TEXT) {
            $type = TextType::class;
        } else if ($this->getTypeElement()->getId() == TypeElement::$TYPE_TEXTAREA) {
            $type = TextareaType::class;
        } else if ($this->getTypeElement()->getId() == TypeElement::$TYPE_NOMBRE) {
            $type = NumberType::class;
        } else if ($this->getTypeElement()->getId() == TypeElement::$TYPE_CHECKBOX) {
            $type = CheckboxType::class;
        } else if ($this->getTypeElement()->getId() == TypeElement::$TYPE_SELECT) {
            $type = CheckboxType::class;
            $choices = array();
            foreach ($this->getDonneesClientElements() as $donneeClientElement) {
                $donneClient = $donneeClientElement->getDonneeClient();
                $choices[] = array($donneeClientElement->getLibelle() => $donneClient->getId());
            }
            $properties[] = $choices;
        }

        $form->add('element', $type, $properties);
        return $form;
    }

}
