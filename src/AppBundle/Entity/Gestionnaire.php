<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToMany;
use Symfony\Component\Validator\Constraints as Assert;




/**
 * Gestionnaire
 *
 * @ORM\Table(name="gestionnaire")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GestionnaireRepository")
 */
class Gestionnaire
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
     * @ORM\Column(name="cin", type="string", length=255)
     * @Assert\Length(min = "8", max = "8", maxMessage="Cin doit etre numerique de taille 8")
     */
    private $cin;

    /**
     * @var string
     *
     * @ORM\Column(name="nomprenom", type="string", length=255)
     * @Assert\Regex(
     *     pattern     = "/^[a-z]+$/i",
     *     htmlPattern = "^[a-zA-Z]+$"
     * )
     */
    private $nomprenom;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="adress", type="string", length=255)
     */
    private $adress;


    /**
     * One product has many features. This is the inverse side.
     * @OneToMany(targetEntity="AppBundle\Entity\chauffeur", mappedBy="idGest")
     */
    private $idChauf;


    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

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
     * Set cin
     *
     * @param string $cin
     *
     * @return Gestionnaire
     */
    public function setCin($cin)
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * Get cin
     *
     * @return string
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * Set nomprenom
     *
     * @param string $nomprenom
     *
     * @return Gestionnaire
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
     * Set email
     *
     * @param string $email
     *
     * @return Gestionnaire
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set adress
     *
     * @param string $adress
     *
     * @return Gestionnaire
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
     * Constructor
     */
    public function __construct()
    {
        $this->idChauf = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add idChauf
     *
     * @param \AppBundle\Entity\chauffeur $idChauf
     *
     * @return Gestionnaire
     */
    public function addIdChauf(\AppBundle\Entity\chauffeur $idChauf)
    {
        $this->idChauf[] = $idChauf;

        return $this;
    }

    /**
     * Remove idChauf
     *
     * @param \AppBundle\Entity\chauffeur $idChauf
     */
    public function removeIdChauf(\AppBundle\Entity\chauffeur $idChauf)
    {
        $this->idChauf->removeElement($idChauf);
    }

    /**
     * Get idChauf
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdChauf()
    {
        return $this->idChauf;
    }
}
