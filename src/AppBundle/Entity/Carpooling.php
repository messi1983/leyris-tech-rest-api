<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Outils\DateOutils;
use AppBundle\Constants\Constants;

/**
 * Carpooling
 * 
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\CarpoolingRepository")
 */
class Carpooling extends AbstractEntity
{
	/**
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Compte", inversedBy="annonces", cascade={"persist", "merge"})
	 */
	private $driverCompte;
	
	/**
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\ReservationCp", mappedBy="carpooling", cascade={"persist", "remove", "merge"})
	 */
	private $reservations;
	
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="price", type="integer")
	 */
	private $price;
	
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="nbPlacesRestantes", type="integer")
	 */
	private $nbPlacesRestantes;
	
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDepart", type="datetime")
     */
    private $dateDepart;
    
    /**
     * @var \Date
     *
     * @ORM\Column(name="dateRetour", type="datetime", nullable=true)
     */
    private $dateRetour;
    
    /**
     * @ORM\Embedded(class = "AppBundle\Entity\Trajet", columnPrefix="trajet")
     */
    private $trajet;
    
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Question", cascade={"persist", "remove", "merge"})
     * @ORM\JoinTable(name="question_carpooling")
     */
    private $questions;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="allerRetour", type="boolean")
     */
    private $allerRetour;
    
    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=255, nullable=true)
     */
    private $comment;
    
    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\OffreCp", cascade={"persist", "merge"}, inversedBy="carpooling")
     */
    private $offreEmise;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="acceptationAuto", type="boolean")
     */
    private $acceptationAuto;
    
    /**
     * @ORM\Column(name="etat", type="string", columnDefinition="enum('VALIDE', 'ANNULE')")
     */
    private $etat;
    
    /**
     * Constructor
     */
    public function __construct()
    {
    	$this->trajet = new Trajet(null, null);
    	$this->allerRetour = false;
    	$this->etat = 'VALIDE';
    	$this->acceptationAuto = false;
    	$this->reservations = new \Doctrine\Common\Collections\ArrayCollection();
    	$this->questions = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set trajet
     *
     * @param \AppBundle\Entity\Trajet $trajet
     * @return Carpooling
     */
    public function setTrajet(\AppBundle\Entity\Trajet $trajet = null)
    {
        $this->trajet = $trajet;
    
        return $this;
    }

    /**
     * Get trajet
     *
     * @return \AppBundle\Entity\Tajet 
     */
    public function getTrajet()
    {
        return $this->trajet;
    }
    
    public function isComplete()
    {
    	return $this->nbPlacesRestantes === 0;
    }
    
    public function getHeureDepart()
    {
    	if($this->dateDepart !== null) {
    		return $this->dateDepart->format(Constants::RESTRICT_TIME_FORMAT);
    	}
    	return null;
    }
    

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Carpooling
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set dateDepart
     *
     * @param \DateTime $dateDepart
     *
     * @return Carpooling
     */
    public function setDateDepart($dateDepart)
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    /**
     * Get dateDepart
     *
     * @return \DateTime
     */
    public function getDateDepart()
    {
        return $this->dateDepart;
    }

    /**
     * Set dateRetour
     *
     * @param \DateTime $dateRetour
     *
     * @return Carpooling
     */
    public function setDateRetour($dateRetour)
    {
        $this->dateRetour = $dateRetour;

        return $this;
    }

    /**
     * Get dateRetour
     *
     * @return \DateTime
     */
    public function getDateRetour()
    {
        return $this->dateRetour;
    }

    /**
     * Set allerRetour
     *
     * @param boolean $allerRetour
     *
     * @return Carpooling
     */
    public function setAllerRetour($allerRetour)
    {
        $this->allerRetour = $allerRetour;

        return $this;
    }

    /**
     * Get allerRetour
     *
     * @return boolean
     */
    public function getAllerRetour()
    {
        return $this->allerRetour;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Carpooling
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set acceptationAuto
     *
     * @param boolean $acceptationAuto
     *
     * @return Carpooling
     */
    public function setAcceptationAuto($acceptationAuto)
    {
        $this->acceptationAuto = $acceptationAuto;

        return $this;
    }

    /**
     * Get acceptationAuto
     *
     * @return boolean
     */
    public function isAcceptationAuto()
    {
        return $this->acceptationAuto;
    }

    /**
     * Set driver
     *
     * @param \AppBundle\Entity\User $driver
     *
     * @return Carpooling
     */
    public function setDriver(\AppBundle\Entity\User $driver = null)
    {
        $this->driver = $driver;

        return $this;
    }

    /**
     * Add reservation
     *
     * @param \AppBundle\Entity\ReservationCp $reservation
     *
     * @return Carpooling
     */
    public function addReservation(\AppBundle\Entity\ReservationCp $reservation)
    {
    	if($reservation->getEtat() !== 'REFUSEE') {
	        $this->reservations[] = $reservation;
	        $reservation->setCarpooling($this);
	        $this->nbPlacesRestantes--;
    	}

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
        $this->nbPlacesRestantes++;
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
     * Add question
     *
     * @param \AppBundle\Entity\Question $question
     *
     * @return Carpooling
     */
    public function addQuestion(\AppBundle\Entity\Question $question)
    {
        $this->questions[] = $question;

        return $this;
    }

    /**
     * Remove question
     *
     * @param \AppBundle\Entity\Question $question
     */
    public function removeQuestion(\AppBundle\Entity\Question $question)
    {
        $this->questions->removeElement($question);
    }

    /**
     * Get questions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * Set offreEmise
     *
     * @param \AppBundle\Entity\OffreCp $offreEmise
     *
     * @return Carpooling
     */
    public function setOffreEmise(\AppBundle\Entity\OffreCp $offreEmise = null)
    {
        $this->offreEmise = $offreEmise;

        return $this;
    }

    /**
     * Get offreEmise
     *
     * @return \AppBundle\Entity\OffreCp
     */
    public function getOffreEmise()
    {
        return $this->offreEmise;
    }

    /**
     * Set nbPlacesRestantes
     *
     * @param integer $nbPlacesRestantes
     *
     * @return Carpooling
     */
    public function setNbPlacesRestantes($nbPlacesRestantes)
    {
        $this->nbPlacesRestantes = $nbPlacesRestantes;

        return $this;
    }

    /**
     * Get nbPlacesRestantes
     *
     * @return integer
     */
    public function getNbPlacesRestantes()
    {
        return $this->nbPlacesRestantes;
    }

    /**
     * Set driverCompte
     *
     * @param \AppBundle\Entity\Compte $driverCompte
     *
     * @return Carpooling
     */
    public function setDriverCompte(\AppBundle\Entity\Compte $driverCompte = null)
    {
        $this->driverCompte = $driverCompte;

        return $this;
    }

    /**
     * Get driverCompte
     *
     * @return \AppBundle\Entity\Compte
     */
    public function getDriverCompte()
    {
        return $this->driverCompte;
    }
    
    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Carpooling
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

    /**
     * Get acceptationAuto
     *
     * @return boolean
     */
    public function getAcceptationAuto()
    {
        return $this->acceptationAuto;
    }
}
