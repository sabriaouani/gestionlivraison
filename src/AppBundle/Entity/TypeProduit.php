<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * TypeProduit
 *
 * @ORM\Table(name="type_produit")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TypeProduitRepository")
 */
class TypeProduit
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
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * One product has many features. This is the inverse side.
     * @OneToMany(targetEntity="AppBundle\Entity\Produit", mappedBy="IdType")
     * @JoinColumn(name="IdProduit", referencedColumnName="id")
     */
    private $IdProduit;


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
     * Set type
     *
     * @param string $type
     *
     * @return TypeProduit
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->IdProduit = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add idProduit
     *
     * @param \AppBundle\Entity\Produit $idProduit
     *
     * @return TypeProduit
     */
    public function addIdProduit(\AppBundle\Entity\Produit $idProduit)
    {
        $this->IdProduit[] = $idProduit;

        return $this;
    }

    /**
     * Remove idProduit
     *
     * @param \AppBundle\Entity\Produit $idProduit
     */
    public function removeIdProduit(\AppBundle\Entity\Produit $idProduit)
    {
        $this->IdProduit->removeElement($idProduit);
    }

    /**
     * Get idProduit
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdProduit()
    {
        return $this->IdProduit;
    }

    public function __toString()
    {
        return $this->type;
    }

}
