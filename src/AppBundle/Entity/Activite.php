<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activite
 *
 * @ORM\Table(name="activite")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ActiviteRepository")
 */
class Activite
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
     * Many Users have Many Groups.
     * @ORM\ManyToMany(targetEntity="Element")
     * @ORM\JoinTable(name="activites_elements",
     *      joinColumns={@ORM\JoinColumn(name="id_activite", referencedColumnName="id")},
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
     * @return Activite
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

    /**
     * Get listeElements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getListeElements()
    {
        return $this->listeElements;
    }
}
