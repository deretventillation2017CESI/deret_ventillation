<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Element", mappedBy="listElements")
     */
    private $elements;


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
}

