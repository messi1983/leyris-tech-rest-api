<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Constants\Constants;

/**
 * Trajet
 *
 * @ORM\Embeddable()
 */
class Trajet
{
    /**
     * @var string
     *
     * @ORM\Column(name="villeDepart", type="string", length=255)
     */
    private $villeDepart;
    
    /**
     * @var string
     *
     * @ORM\Column(name="pointDepart", type="string", length=255, nullable=true)
     */
    private $pointDepart;

    /**
     * @var string
     *
     * @ORM\Column(name="villeArrivee", type="string", length=255)
     */
    private $villeArrivee;
    
    /**
     * @var string
     *
     * @ORM\Column(name="pointArrivee", type="string", length=255, nullable=true)
     */
    private $pointArrivee;
    
    /**
     * Constructor
     */
    public function __construct($villeDepart, $villeArrivee)
    {
    	$this->villeDepart = $villeDepart;
    	$this->villeArrivee = $villeArrivee;
    }
    
    /**
     * Set villeDepart
     *
     * @param string $villeDepart
     * @return Trajet
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
     * @return Trajet
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
     * @return Trajet
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
     * @return Trajet
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