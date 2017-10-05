<?php

namespace AppBundle\DTO;

/**
 * Dto Resultat Recherche Cp
 */
class ResultatRechercheCpDto
{
    private $dateTimesInterval;
    
    private $page;
    
    private $trajet;
    
    private $carpoolings; 
    
    private $nbPages;
    
    /**
     * Constructor
     */
    public function __construct($trajet, $dateTimesInterval, $page, $carpoolings, $nbPages)
    {
        $this->carpoolings = $carpoolings;
        $this->trajet = $trajet;
        $this->dateTimesInterval = $dateTimesInterval;
        $this->page = $page;
        $this->nbPages = $nbPages;
    }
    
    /**
     * Set dateTimesInterval
     *
     * @param array $dateTimesIntervalte
     * @return ResultatRechercheCpDto
     */
    public function setDateTimesInterval($dateTimesInterval)
    {
    	$this->dateTimesInterval = $dateTimesInterval;
    
    	return $this;
    }
    
    /**
     * Get dateTimesInterval
     *
     * @return array
     */
    public function getDateTimesInterval()
    {
    	return $this->dateTimesInterval;
    }
    
    /**
     * Set page
     *
     * @param string $page
     * @return ResultatRechercheCpDto
     */
    public function setPage($page)
    {
    	$this->page = $page;
    
    	return $this;
    }
    
    /**
     * Get page
     *
     * @return integer
     */
    public function getPage()
    {
    	return $this->page;
    }
    
    /**
     * Set trajet
     *
     * @param string $trajet
     * @return ResultatRechercheCpDto
     */
    public function setTrajet(\AppBundle\DTO\TrajetDto $trajet)
    {
    	$this->trajet = $trajet;
    
    	return $this;
    }
    
    /**
     * Get trajet
     *
     * @return \AppBundle\DTO\Trajet
     */
    public function getTrajet()
    {
    	return $this->trajet;
    }
    
    /**
     * Set nbPages
     *
     * @param integer $nbPages
     * @return ResultatRechercheCpDto
     */
    public function setNbPages($nbPages)
    {
    	$this->nbPages = $nbPages;
    
    	return $this;
    }
    
    /**
     * Get nbPages
     *
     * @return integer
     */
    public function getNbPages()
    {
    	return $this->nbPages;
    }
    
    /**
     * Get carpoolings
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function setCarpoolings($carpoolings)
    {
    	$this->carpoolings = $carpoolings;
    	
    	return $this;
    }
    
    /**
     * Get carpoolings
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCarpoolings()
    {
    	return $this->carpoolings;
    }
   
}