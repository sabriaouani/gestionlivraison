<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * Mission
 *
 * @ORM\Table(name="mission")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MissionRepository")
 */
class Mission
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
     * @var \DateTime
     *
     * @ORM\Column(name="DateMis", type="datetime")
     */
    private $dateMis;
    /**
     * Many features have one product. This is the owning side.
     * @ManyToOne(targetEntity="AppBundle\Entity\chauffeur", inversedBy="IdMission")
     * @JoinColumn(name="IdChauf", referencedColumnName="id")
     */
    private $IdChauf;

    /**
     * One product has many features. This is the inverse side.
     * @OneToMany(targetEntity="AppBundle\Entity\Client", mappedBy="IdMission", cascade={"persist"})
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
     * Set dateMis
     *
     * @param \DateTime $dateMis
     *
     * @return Mission
     */
    public function setDateMis($dateMis)
    {
        $this->dateMis = $dateMis;

        return $this;
    }

    /**
     * Get dateMis
     *
     * @return \DateTime
     */
    public function getDateMis()
    {
        return $this->dateMis;
    }

    /**
     * Set idChauf
     *
     * @param \AppBundle\Entity\chauffeur $idChauf
     *
     * @return Mission
     */
    public function setIdChauf(\AppBundle\Entity\chauffeur $idChauf = null)
    {
        $this->IdChauf = $idChauf;

        return $this;
    }

    /**
     * Get idChauf
     *
     * @return \AppBundle\Entity\chauffeur
     */
    public function getIdChauf()
    {
        return $this->IdChauf;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->IdProduit = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Mission
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set adress
     *
     * @param string $adress
     *
     * @return Mission
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * Get adress
     *
     * @return string
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set tel
     *
     * @param string $tel
     *
     * @return Mission
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }





    /**
     * Add idClient
     *
     * @param \AppBundle\Entity\Client $idClient
     *
     * @return Mission
     */
    public function addIdClient(\AppBundle\Entity\Client $idClient)
    {
        $this->IdClient[] = $idClient;
        $idClient->setIdMission($this);

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
