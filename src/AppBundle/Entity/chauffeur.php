<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * chauffeur
 *
 * @ORM\Table(name="chauffeur")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\chauffeurRepository")
 */
class chauffeur
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
     * @ORM\Column(name="nomprenom", type="string", length=255)
     */
    private $nomprenom;

    /**
     * @var int
     *
     * @ORM\Column(name="cin", type="integer")
     */
    private $cin;

    /**
     * @var int
     *
     * @ORM\Column(name="tel", type="integer")
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="rate", type="string", length=255)
     */
    private $rate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datenes", type="date")
     */
    private $datenes;

    /**
     * Many features have one product. This is the owning side.
     * @ManyToOne(targetEntity="AppBundle\Entity\Gestionnaire", inversedBy="idChauf")
     * @JoinColumn(name="idGest", referencedColumnName="id")
     */
    private $idGest;
    /**
     * One product has many features. This is the inverse side.
     * @OneToMany(targetEntity="AppBundle\Entity\Mission", mappedBy="IdChauf")
     * @JoinColumn(name="IdMission", referencedColumnName="id")
     */
    private $IdMission;



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
     * Set nomprenom
     *
     * @param string $nomprenom
     *
     * @return chauffeur
     */
    public function setNomprenom($nomprenom)
    {
        $this->nomprenom = $nomprenom;

        return $this;
    }

    /**
     * Get nomprenom
     *
     * @return string
     */
    public function getNomprenom()
    {
        return $this->nomprenom;
    }

    /**
     * Set cin
     *
     * @param integer $cin
     *
     * @return chauffeur
     */
    public function setCin($cin)
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * Get cin
     *
     * @return int
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * Set tel
     *
     * @param integer $tel
     *
     * @return chauffeur
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return int
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set rate
     *
     * @param string $rate
     *
     * @return chauffeur
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return string
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set datenes
     *
     * @param \DateTime $datenes
     *
     * @return chauffeur
     */
    public function setDatenes($datenes)
    {
        $this->datenes = $datenes;

        return $this;
    }

    /**
     * Get datenes
     *
     * @return \DateTime
     */
    public function getDatenes()
    {
        return $this->datenes;
    }



    /**
     * Set idGest
     *
     * @param \AppBundle\Entity\Gestionnaire $idGest
     *
     * @return chauffeur
     */
    public function setIdGest(\AppBundle\Entity\Gestionnaire $idGest = null)
    {
        $this->idGest = $idGest;

        return $this;
    }

    /**
     * Get idGest
     *
     * @return \AppBundle\Entity\Gestionnaire
     */
    public function getIdGest()
    {
        return $this->idGest;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->IdMission = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add idMission
     *
     * @param \AppBundle\Entity\Mission $idMission
     *
     * @return chauffeur
     */
    public function addIdMission(\AppBundle\Entity\Mission $idMission)
    {
        $this->IdMission[] = $idMission;

        return $this;
    }

    /**
     * Remove idMission
     *
     * @param \AppBundle\Entity\Mission $idMission
     */
    public function removeIdMission(\AppBundle\Entity\Mission $idMission)
    {
        $this->IdMission->removeElement($idMission);
    }

    /**
     * Get idMission
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdMission()
    {
        return $this->IdMission;
    }

    public function __toString()
    {
        return $this->nomprenom;
    }


}
