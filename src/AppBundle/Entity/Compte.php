<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Outils\DateOutils;
use Doctrine\ORM\Mapping\JoinTable;

/**
 * Compte
 * 
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\CompteRepository")
 */
class Compte extends AbstractPulishedEntity
{
	/**
	 * @ORM\OneToOne(targetEntity="AppBundle\Entity\User", cascade={"persist", "merge"})
	 */
	private $owner;
	
	/**
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\Carpooling", mappedBy="driverCompte", cascade={"persist" , "merge"})
	 */
	private $annonces;
	
	/**
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\ReservationCp", mappedBy="userCompte", cascade={"persist", "remove", "merge"})
	 */
	private $reservations;
	
	/**
	 * @ORM\ManyToMany(targetEntity="AppBundle\Entity\RechercheCp", cascade={"persist" , "merge"})
	 */
	private $recherches;
	
	/**
	 * @ORM\ManyToMany(targetEntity="AppBundle\Entity\OffreCp", inversedBy="destinataires")
	 */
	private $offreCpRecues;
	
	/**
	 * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User", cascade={"persist" , "merge"})
	 */
	private $contacts;
	
    /**
     * Constructor
     */
    public function __construct()
    {
    	parent::__construct();
    	
    	$this->annonces = new \Doctrine\Common\Collections\ArrayCollection();
    	$this->reservations = new \Doctrine\Common\Collections\ArrayCollection();
    	$this->recherches = new \Doctrine\Common\Collections\ArrayCollection();
    	$this->offreCpRecues = new \Doctrine\Common\Collections\ArrayCollection();
    	$this->contacts = new \Doctrine\Common\Collections\ArrayCollection();
    }
  

    /**
     * Set owner
     *
     * @param \AppBundle\Entity\User $owner
     *
     * @return Compte
     */
    public function setOwner(\AppBundle\Entity\User $owner = null)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return \AppBundle\Entity\User
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Add reservation
     *
     * @param \AppBundle\Entity\ReservationCp $reservation
     *
     * @return Compte
     */
    public function addReservation(\AppBundle\Entity\ReservationCp $reservation)
    {
        $this->reservations[] = $reservation;

        return $this;
    }

    /**
     * Remove reservation
     *
     * @param \AppBundle\Entity\ReservationCp $reservation
     */
    public function removeReservation(\AppBundle\Entity\ReservationCp $reservation)
    {
        $this->reservations->removeElement($reservation);
    }

    /**
     * Get reservations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReservations()
    {
        return $this->reservations;
    }

    /**
     * Add recherch
     *
     * @param \AppBundle\Entity\RechercheCp $recherch
     *
     * @return Compte
     */
    public function addRecherch(\AppBundle\Entity\RechercheCp $recherch)
    {
        $this->recherches[] = $recherch;

        return $this;
    }

    /**
     * Remove recherch
     *
     * @param \AppBundle\Entity\RechercheCp $recherch
     */
    public function removeRecherch(\AppBundle\Entity\RechercheCp $recherch)
    {
        $this->recherches->removeElement($recherch);
    }

    /**
     * Get recherches
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRecherches()
    {
        return $this->recherches;
    }

    /**
     * Add offreCpRecue
     *
     * @param \AppBundle\Entity\OffreCp $offreCpRecue
     *
     * @return Compte
     */
    public function addOffreCpRecue(\AppBundle\Entity\OffreCp $offreCpRecue)
    {
        $this->offreCpRecues[] = $offreCpRecue;

        return $this;
    }

    /**
     * Remove offreCpRecue
     *
     * @param \AppBundle\Entity\OffreCp $offreCpRecue
     */
    public function removeOffreCpRecue(\AppBundle\Entity\OffreCp $offreCpRecue)
    {
        $this->offreCpRecues->removeElement($offreCpRecue);
    }

    /**
     * Get offreCpRecues
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOffreCpRecues()
    {
        return $this->offreCpRecues;
    }

    /**
     * Add contact
     *
     * @param \AppBundle\Entity\User $contact
     *
     * @return Compte
     */
    public function addContact(\AppBundle\Entity\User $contact)
    {
        $this->contacts[] = $contact;

        return $this;
    }

    /**
     * Remove contact
     *
     * @param \AppBundle\Entity\User $contact
     */
    public function removeContact(\AppBundle\Entity\User $contact)
    {
        $this->contacts->removeElement($contact);
    }

    /**
     * Get contacts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * Add annonce
     *
     * @param \AppBundle\Entity\Carpooling $annonce
     *
     * @return Compte
     */
    public function addAnnonce(\AppBundle\Entity\Carpooling $annonce)
    {
        $this->annonces[] = $annonce;

        return $this;
    }

    /**
     * Remove annonce
     *
     * @param \AppBundle\Entity\Carpooling $annonce
     */
    public function removeAnnonce(\AppBundle\Entity\Carpooling $annonce)
    {
        $this->annonces->removeElement($annonce);
    }

    /**
     * Get annonces
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnnonces()
    {
        return $this->annonces;
    }
}
