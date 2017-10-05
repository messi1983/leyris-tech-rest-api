<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Constants\Constants;

/**
 * Periode
 *
 * @ORM\Embeddable()
 */
class Periode
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="datetime")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="datetime", nullable=true)
     */
    private $dateFin;
    
    /**
     * Constructor
     */
    public function __construct($dateDebut, $dateFin)
    {
    	$this->dateDebut = $dateDebut;
    	$this->dateFin = $dateFin;
    }
    
    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return Periode
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    
        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime 
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     * @return Periode
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    
        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime 
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }
    
    /**
     * Get State
     *
     * @return string
     */
    public function getState()
    {
    	if ($this->dateDebut !== null && $this->dateFin !== null) {
    		return Constants::STATE_FINISHED;
    	} else if($this->dateDebut !== null) {
    		return Constants::STATE_CURRENT;
    	}
    	return Constants::STATE_UNKNOWN;
    }
    
    /**
     * Get DateDebut in string format
     *
     * @return string
     */
    public function getDateDebutInString()
    {
    	$dateInStr = null;
    	if ($this->dateDebut !== null) {
    		$dateInStr = $this->dateDebut->format(Constants::DATE_FORMAT_WITH_DAY);
    	} 
    	return $dateInStr;
    }
}