<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Symfony\Component\Validator\Constraints as Assert;


/**
 *ProClient
 * @ORM\Table(name="pro_client")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProClientRepository")

 */
class  ProClient
{


    /**
     * @ManyToOne(targetEntity="AppBundle\Entity\Client")
     * @JoinColumn(name="id_client", referencedColumnName="id")
     * @ORM\Id

     */
    private $id_client;


    /**
     * @ManyToOne(targetEntity="AppBundle\Entity\Produit")
     * @JoinColumn(name="id_produit", referencedColumnName="id")
     * @ORM\Id

     */
    private $id_produit;

    /**
     * @var int
     *
     * @ORM\Column(name="exist", type="integer")
     */
    private $exist;

    /**
     * @var string
     *
     * @ORM\Column(name="nomClient", type="string", length=255)
     */
    private $nomclient;

    /**
     * @var string
     *
     * @ORM\Column(name="nomproduit", type="string", length=255)
     */
    private $nomproduit;

    /**
     * @return string
     */
    public function getNomclient()
    {
        return $this->nomclient;
    }

    /**
     * @param string $nomclient
     */
    public function setNomclient($nomclient)
    {
        $this->nomclient = $nomclient;
    }

    /**
     * @return string
     */
    public function getNomproduit()
    {
        return $this->nomproduit;
    }

    /**
     * @param string $nomproduit
     */
    public function setNomproduit($nomproduit)
    {
        $this->nomproduit = $nomproduit;
    }


    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }



    /**
     * @return mixed
     */
    public function getIdClient()
    {
        return $this->id_client;
    }

    /**
     * @param mixed $id_client
     */
    public function setIdClient($id_client)
    {
        $this->id_client = $id_client;
    }

    /**
     * @return mixed
     */
    public function getIdProduit()
    {
        return $this->id_produit;
    }

    /**
     * @param mixed $id_produit
     */
    public function setIdProduit($id_produit)
    {
        $this->id_produit = $id_produit;
    }

    /**
     * @return int
     */
    public function getExist()
    {
        return $this->exist;
    }

    /**
     * @param int $exist
     */
    public function setExist($exist)
    {
        $this->exist = $exist;
    }




}
