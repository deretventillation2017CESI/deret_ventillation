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
     * @ManyToMany(targetEntity="Element")
     * @JoinTable(name="activites_elements",
     *      joinColumns={@JoinColumn(name="id_activite", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="id_element", referencedColumnName="id")}
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
}

