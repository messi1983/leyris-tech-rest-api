<?php

namespace AppBundle\DTO;

/**
 * TrajetDto
 */
class TrajetDto
{
    /**
     * @var string
     */
    private $villeDepart;
    
    /**
     * @var string
     */
    private $pointDepart;

    /**
     * @var string
     */
    private $villeArrivee;
    
    /**
     * @var string
     */
    private $pointArrivee;
    
    /**
     * Set villeDepart
     *
     * @param string $villeDepart
     * @return TrajetDto
     */
    public function setVilleDepart($villeDepart)
    {
        $this->villeDepart = $villeDepart;
    
        return $this;
    }

    /**
     * Get string
     *
     * @return string 
     */
    public function getVilleDepart()
    {
        return $this->villeDepart;
    }

    /**
     * Set villeArrivee
     *
     * @param string $villeArrivee
     * @return TrajetDto
     */
    public function setVilleArrivee($villeArrivee)
    {
        $this->villeArrivee = $villeArrivee;
    
        return $this;
    }

    /**
     * Get string
     *
     * @return string 
     */
    public function getVilleArrivee()
    {
        return $this->villeArrivee;
    }
    

    /**
     * Set pointDepart
     *
     * @param string $pointDepart
     * @return TrajetDto
     */
    public function setPointDepart($pointDepart)
    {
        $this->pointDepart = $pointDepart;
    
        return $this;
    }

    /**
     * Get pointDepart
     *
     * @return string 
     */
    public function getPointDepart()
    {
        return $this->pointDepart;
    }

    /**
     * Set pointArrivee
     *
     * @param string $pointArrivee
     * @return TrajetDto
     */
    public function setPointArrivee($pointArrivee)
    {
        $this->pointArrivee = $pointArrivee;
    
        return $this;
    }

    /**
     * Get pointArrivee
     *
     * @return string 
     */
    public function getPointArrivee()
    {
        return $this->pointArrivee;
    }
}