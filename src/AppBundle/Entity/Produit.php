<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProduitRepository")
 */
class Produit
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
     * @ORM\Column(name="NomProduit", type="string", length=255)
     */
    private $nomProduit;
    /**
     * @var int
     *
     * @ORM\Column(name="nbProduit", type="integer")
     */
    private $nbProduit;

    /**
     * Many features have one product. This is the owning side.
     * @ManyToOne(targetEntity="AppBundle\Entity\TypeProduit", inversedBy="IdProduit")
     * @JoinColumn(name="IdType", referencedColumnName="id")
     */
    private $IdType;

    /**
     * One product has many features. This is the inverse side.
     * @OneToMany(targetEntity="AppBundle\Entity\Client", mappedBy="IdProduit")
     */
    private $IdClient;

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
     * Set nomProduit
     *
     * @param string $nomProduit
     *
     * @return Produit
     */
    public function setNomProduit($nomProduit)
    {
        $this->nomProduit = $nomProduit;

        return $this;
    }

    /**
     * Get nomProduit
     *
     * @return string
     */
    public function getNomProduit()
    {
        return $this->nomProduit;
    }



    /**
     * Set nbProduit
     *
     * @param integer $nbProduit
     *
     * @return Produit
     */
    public function setNbProduit($nbProduit)
    {
        $this->nbProduit = $nbProduit;

        return $this;
    }

    /**
     * Get nbProduit
     *
     * @return int
     */
    public function getNbProduit()
    {
        return $this->nbProduit;
    }

    /**
     * Set idType
     *
     * @param \AppBundle\Entity\TypeProduit $idType
     *
     * @return Produit
     */
    public function setIdType(\AppBundle\Entity\TypeProduit $idType = null)
    {
        $this->IdType = $idType;

        return $this;
    }

    /**
     * Get idType
     *
     * @return \AppBundle\Entity\TypeProduit
     */
    public function getIdType()
    {
        return $this->IdType;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->IdClient = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add idClient
     *
     * @param \AppBundle\Entity\Client $idClient
     *
     * @return Produit
     */
    public function addIdClient(\AppBundle\Entity\Client $idClient)
    {
        $this->IdClient[] = $idClient;

        return $this;
    }

    /**
     * Remove idClient
     *
     * @param \AppBundle\Entity\Client $idClient
     */
    public function removeIdClient(\AppBundle\Entity\Client $idClient)
    {
        $this->IdClient->removeElement($idClient);
    }

    /**
     * Get idClient
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdClient()
    {
        return $this->IdClient;
    }
}
