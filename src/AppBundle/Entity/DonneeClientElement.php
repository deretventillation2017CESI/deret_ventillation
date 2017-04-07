<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DonneeClientElement
 *
 * @ORM\Table(name="donnee_client_element")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DonneeClientElementRepository")
 */
class DonneeClientElement {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int 
     * @ORM\ManyToOne(targetEntity="Element")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $id_element_cible;

    /**
     * @var int 
     * @ORM\ManyToOne(targetEntity="Element", inversedBy="donneesClientElements;")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $element;

    /**
     * @var int 
     * @ORM\ManyToOne(targetEntity="DonneeClient")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $donneClient;

    function getDonneClient() {
        return $this->donneClient;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    function getId_element_cible() {
        return $this->id_element_cible;
    }

    function setId_element_cible($id_element_cible) {
        $this->id_element_cible = $id_element_cible;
    }

}
