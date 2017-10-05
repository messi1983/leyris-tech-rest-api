<?php

namespace AppBundle\DTO;

/**
 * Dto Resultat Recherche Cp
 */
class ResultatRechercheCpOnDatesIntervalDto
{
    private $datesInterval;
    
    private $mainDate;
    
    private $trajet;
    
    private $nbCpForEachDepartureDate; 
    
    /**
     * Constructor
     */
    public function __construct($trajet, $datesInterval, $mainDate, $nbCpForEachDepartureDate)
    {
        $this->nbCpForEachDepartureDate = $nbCpForEachDepartureDate;
        $this->trajet = $trajet;
        $this->datesInterval = $datesInterval;
        $this->mainDate = $mainDate;
    }
    
    /**
     * Set datesInterval
     *
     * @param array $datesIntervalte
     * @return ResultatRechercheCpOnDatesIntervalDto
     */
    public function setDatesInterval($datesInterval)
    {
    	$this->datesInterval = $datesInterval;
    
    	return $this;
    }
    
    /**
     * Get datesInterval
     *
     * @return array
     */
    public function getDatesInterval()
    {
    	return $this->datesInterval;
    }
    
    /**
     * Set mainDate
     *
     * @param string $mainDate
     * @return ResultatRechercheCpOnDatesIntervalDto
     */
    public function setMainDate($mainDate)
    {
    	$this->mainDate = $mainDate;
    
    	return $this;
    }
    
    /**
     * Get mainDate
     *
     * @return string 
     */
    public function getMainDate()
    {
    	return $this->mainDate;
    }
    
    /**
     * Set trajet
     *
     * @param string $trajet
     * @return ResultatRechercheCpOnDatesIntervalDto
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
     * Get nbCpForEachDepartureDate
     *
     * @return ResultatRechercheCpOnDatesIntervalDto
     */
    public function setNbCpForEachDepartureDate($nbCpForEachDepartureDate)
    {
    	$this->nbCpForEachDepartureDate = $nbCpForEachDepartureDate;
    	
    	return $this;
    }
    
    /**
     * Get nbCpForEachDepartureDate
     *
     * @return array
     */
    public function getNbCpForEachDepartureDate()
    {
    	return $this->nbCpForEachDepartureDate;
    }
   
}