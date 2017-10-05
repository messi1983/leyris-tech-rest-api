<?php

namespace AppBundle\DTO;


/**
 * Statistiques
 */
class Statistiques
{
    private $trajet;
    
    private $stats;
    
    /**
     * Constructor
     */
    public function __construct($trajet, $stats)
    {
    	$this->stats = $stats;
    	$this->trajet = $trajet;
    }
    
    /**
     * Set $trajet
     *
     * @param TrajetDto $trajet
     * @return TrajetDto
     */
    public function setTrajet(TrajetDto $trajet)
    {
    	$this->trajet = $trajet;
    
    	return $this;
    }
    
    /**
     * Get trajet
     *
     * @return TrajetDto
     */
    public function getTrajet()
    {
    	return $this->trajet;
    }
    
    /**
     * Set stats
     *
     * @param array stats
     * @return Statistiques
     */
    public function setStats($stats)
    {
    	$this->stats = $stats;
    
    	return $this;
    }
    
    /**
     * Get stats
     *
     * @return array
     */
    public function getStats()
    {
    	return $this->stats;
    }
   
}