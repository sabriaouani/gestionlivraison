<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * msg_ch
 *
 * @ORM\Table(name="msg_ch")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\msg_chRepository")
 */
class msg_ch
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
     * @var int
     *
     * @ORM\Column(name="id_ch", type="integer")
     */
    private $idCh;

    /**
     * @var string
     *
     * @ORM\Column(name="msg", type="string", length=255)
     */
    private $msg;

    /**
     * @var string
     *
     * @ORM\Column(name="nomChauf", type="string", length=255)
     */
    private $nomchauf;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_m", type="date")
     */
    private $date_m;


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
     * Set idCh
     *
     * @param integer $idCh
     *
     * @return msg_ch
     */
    public function setIdCh($idCh)
    {
        $this->idCh = $idCh;

        return $this;
    }

    /**
     * Get idCh
     *
     * @return int
     */
    public function getIdCh()
    {
        return $this->idCh;
    }

    /**
     * Set msg
     *
     * @param string $msg
     *
     * @return msg_ch
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;

        return $this;
    }

    /**
     * Get msg
     *
     * @return string
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * Set dateM
     *
     * @param \DateTime $dateM
     *
     * @return msg_ch
     */
    public function setDateM($dateM)
    {
        $this->date_m = $dateM;

        return $this;
    }

    /**
     * Get dateM
     *
     * @return \DateTime
     */
    public function getDateM()
    {
        return $this->date_m;
    }

    /**
     * Set nomchauf
     *
     * @param string $nomchauf
     *
     * @return msg_ch
     */
    public function setNomchauf($nomchauf)
    {
        $this->nomchauf = $nomchauf;

        return $this;
    }

    /**
     * Get nomchauf
     *
     * @return string
     */
    public function getNomchauf()
    {
        return $this->nomchauf;
    }
}
