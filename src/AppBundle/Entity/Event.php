<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Criteria;

/**
 * Event
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\EventRepository")
 */
class Event extends AbstractPulishedEntity
{
    /**
     * @var string
     *
     * @ORM\Column(name="identification", type="string", length=255, nullable=true)
     */
    private $identification;
    
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Soiree", mappedBy="event", cascade={"persist", "remove", "merge"})
     */
    private $soirees; 
    
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Stage", mappedBy="event", cascade={"persist", "remove", "merge"})
     */
    private $stages;
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Adresse", cascade={"persist", "remove"})
     */
    private $adresse;
    
    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Image", cascade={"persist", "remove"})
     */
    private $flyer;
    
    //private $concerts
    //private $commerces
    
    /**
     * Constructor
     */
    public function __construct()
    {
    	parent::__construct();
        $this->soirees = new \Doctrine\Common\Collections\ArrayCollection();
        $this->stages = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add soirees
     *
     * @param \AppBundle\Entity\Soiree $soiree
     * @return Event
     */
    public function addSoiree(\AppBundle\Entity\Soiree $soiree)
    {
        $this->soirees[] = $soiree;
        $soiree->setEvent($this);
    
        return $this;
    }
    
    /**
     * Remove soirees
     *
     * @param \AppBundle\Entity\Soiree $soiree
     */
    public function removeSoiree(\AppBundle\Entity\Soiree $soiree)
    {
        $this->soirees->removeElement($soiree);
    }

    /**
     * Get soirees
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSoirees()
    {
        return $this->soirees;
    }

    /**
     * Add stages
     *
     * @param \AppBundle\Entity\Stage $stage
     * @return Event
     */
    public function addStage(\AppBundle\Entity\Stage $stage)
    {
        $this->stages[] = $stage;
        $stage->setEvent($this);
    
        return $this;
    }

    /**
     * Remove stage
     *
     * @param \AppBundle\Entity\Stage $stage
     */
    public function removeStage(\AppBundle\Entity\Stage $stage)
    {
        $this->stages->removeElement($stage);
    }

    /**
     * Get stages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStages()
    {
        return $this->stages;
    }

    /**
     * Set identification
     *
     * @param string $identification
     * @return Event
     */
    public function setIdentification($identification)
    {
        $this->identification = $identification;
    
        return $this;
    }

    /**
     * Get identification
     *
     * @return string 
     */
    public function getIdentification()
    {
        return $this->identification;
    }

    /**
     * Set adresse
     *
     * @param \AppBundle\Entity\Adresse $adresse
     * @return Event
     */
    public function setAdresse(\AppBundle\Entity\Adresse $adresse = null)
    {
        $this->adresse = $adresse;
    
        return $this;
    }

    /**
     * Get adresse
     *
     * @return \AppBundle\Entity\Adresse 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set flyer
     *
     * @param \AppBundle\Entity\Image $flyer
     * @return Event
     */
    public function setFlyer(\AppBundle\Entity\Image $flyer = null)
    {
        $this->flyer = $flyer;
    
        return $this;
    }

    /**
     * Get flyer
     *
     * @return \AppBundle\Entity\Image 
     */
    public function getFlyer()
    {
        return $this->flyer;
    }

    /**
     * Get desciptif
     *
     * @return string
     */
    public function getDescriptif()
    {
    	return 'descriptif';
    }
    
    /**
     * Get all types of music for the event
     */
    public function  getAmbiances() 
    {
    	$ambiances = array();
    	$arrSoirees = $this->soirees->toArray();
    	
    	foreach ($arrSoirees as $soiree){
    		$ambiances = array_merge($ambiances, $soiree->getAmbiances());
    	}
    	return $ambiances;
    }
    
    /**
     * Get the main organizer
     */
    public function  getMainOrganizer()
    {
    	$arrOrganizers = $this->organisateurs->toArray();
    	
    	if(count($arrOrganizers) !== 0) {
    		return $arrOrganizers[0]->getNom();
    	}
    	
    	return null;
    }
}