<?php

namespace AppBundle\DTO;

use AppBundle\Outils\DateOutils;
use AppBundle\Constants\Constants;

/**
 * CarpoolingDto
 */
class CarpoolingDto extends AbstractDto
{
	private $driver;
	
	private $price;
	
	private $nbPlacesRestantes;
	
    private $dateRetour;
    
    private $trajet;
    
    private $questions;
    
    private $allerRetour;
    
    private $comment;
    
    private $reservations;
    
    private $etat;
    
    private $acceptationAuto;
    
    /**
     * Set trajet
     *
     * @param \AppBundle\DTO\TrajetDto $trajet
     * @return CarpoolingDto
     */
    public function setTrajet(\AppBundle\DTO\TrajetDto $trajet = null)
    {
        $this->trajet = $trajet;
    
        return $this;
    }

    /**
     * Get trajet
     *
     * @return \AppBundle\DTO\Tajet 
     */
    public function getTrajet()
    {
        return $this->trajet;
    }

    /**
     * Set driver
     *
     * @param \AppBundle\DTO\UserDto $driver
     * @return CarpoolingDto
     */
    public function setDriver(\AppBundle\DTO\UserDto $driver = null)
    {
        $this->driver = $driver;
        
        return $this;
    }

    /**
     * Get driver
     *
     * @return \AppBundle\DTO\UserDto 
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * Set allerRetour
     *
     * @param boolean $allerRetour
     * @return CarpoolingDto
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
    public function isAllerRetour()
    {
        return $this->allerRetour;
    }

    /**
     * Set dateDepart
     *
     * @param \DateTime $dateDepart
     * @return CarpoolingDto
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
     * @return CarpoolingDto
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
     * Set price
     *
     * @param integer $price
     * @return CarpoolingDto
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
     * Set comment
     *
     * @param string $comment
     * @return CarpoolingDto
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
     * Add question
     *
     * @param \AppBundle\DTO\Question $question
     * @return CarpoolingDto
     */
    public function addQuestion(\AppBundle\DTO\Question $question)
    {
    	if($question !== null) {
        	$this->questions[] = $question;
    	}
        return $this;
    }

    /**
     * Remove question
     *
     * @param \AppBundle\DTO\Question $question
     */
    public function removeQuestion(\AppBundle\DTO\Question $question)
    {
    	if($question !== null) {
        	$this->questions->removeElement($question);
    	}
    	return $this;
    }

    /**
     * Get questions
     *
     * @return array 
     */
    public function getQuestions()
    {
        return $this->questions;
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
     * Set etat
     *
     * @param string $etat
     *
     * @return CarpoolingDto
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
    
}