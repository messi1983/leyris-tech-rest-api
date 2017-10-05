<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Criteria;

/**
 * Reservation
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ReservationCpRepository")
 */
class ReservationCp extends AbstractEntity
{   
    /**
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Compte", cascade={"persist", "merge"})
	 */
	private $userCompte;
	
	/**
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Carpooling", inversedBy="reservations", cascade={"persist", "merge"})
	 */
	private $carpooling;
    
    /**
	 * @var integer
	 *
	 * @ORM\Column(name="nbPlaces", type="integer")
	 */
	private $nbPlaces;
	
	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="date", type="datetime")
	 */
	private $date;
	
	/**
	 * @var string
	 *
	 * @ORM\Column(name="multiGroupe", type="string", length=25, nullable=true)
	 */
	private $multiGroupe;
	
	/**
	 * @ORM\Column(name="etat", type="string", columnDefinition="enum('EN_COURS', 'ANNULEE', 'ACCEPTEE', 'REFUSEE')", nullable=true)
	 */
	private $etat;
	
    /**
     * Set nbPlaces
     *
     * @param integer $nbPlaces
     *
     * @return ReservationCp
     */
    public function setNbPlaces($nbPlaces)
    {
        $this->nbPlaces = $nbPlaces;

        return $this;
    }

    /**
     * Get nbPlaces
     *
     * @return integer
     */
    public function getNbPlaces()
    {
        return $this->nbPlaces;
    }

    /**
     * Set userCompte
     *
     * @param \AppBundle\Entity\Compte $userCompte
     *
     * @return ReservationCp
     */
    public function setUserCompte(\AppBundle\Entity\Compte $userCompte = null)
    {
        $this->userCompte = $userCompte;
        $this->userCompte->addReservation($this);

        return $this;
    }

    /**
     * Get userCompte
     *
     * @return \AppBundle\Entity\Compte
     */
    public function getUserCompte()
    {
        return $this->compte;
    }

    /**
     * Set carpooling
     *
     * @param \AppBundle\Entity\Carpooling $carpooling
     *
     * @return ReservationCp
     */
    public function setCarpooling(\AppBundle\Entity\Carpooling $carpooling = null)
    {
        $this->carpooling = $carpooling;

        return $this;
    }

    /**
     * Get carpooling
     *
     * @return \AppBundle\Entity\Carpooling
     */
    public function getCarpooling()
    {
        return $this->carpooling;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return ReservationCp
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set multiGroupe
     *
     * @param string $multiGroupe
     *
     * @return ReservationCp
     */
    public function setMultiGroupe($multiGroupe)
    {
        $this->multiGroupe = $multiGroupe;

        return $this;
    }

    /**
     * Get multiGroupe
     *
     * @return string
     */
    public function getMultiGroupe()
    {
        return $this->multiGroupe;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return ReservationCp
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }
    
}
