<?php

namespace AppBundle\DTO;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Criteria;

/**
 * ReservationDto
 *
 */
class ReservationCpDto extends AbstractDto
{   
	private $carpoolingId;
	
	private $user;
	
	private $nbPlaces;
	
	private $date;
	
	private $multiGroupe;
	
	private $etat;
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->etat = 'EN_COURS';
		$this->date = new \DateTime();
	}
	
	/**
	 * Get carpoolingId
	 *
	 * @return integer
	 */
	public function setCarpoolingId($carpoolingId)
	{
		$this->carpoolingId = $carpoolingId;
			
		return $this;
	}
	
	/**
	 * Get carpoolingId
	 *
	 * @return integer
	 */
	public function getCarpoolingId()
	{
		return $this->carpoolingId;
	}
    

    /**
     * Set nbPlaces
     *
     * @param integer $nbPlaces
     *
     * @return ReservationCpDto
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
     * @return ReservationCpDto
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return UserDto
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return ReservationCpDto
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
     * @return ReservationCpDto
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
     * @return ReservationCpDto
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
