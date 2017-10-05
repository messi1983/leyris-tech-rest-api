<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\MappedSuperclass;

/**
 *
 * @MappedSuperclass
 */
abstract class CommonStageSoiree
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptif", type="string", length=255)
     */
    private $desciptif;

    /**
     * @ORM\Embedded(class = "AppBundle\Entity\Periode")
     */
    private $dates;
    
    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Adresse", cascade={"persist", "remove"})
     */
    private $adresse;
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Event", inversedBy="soirees", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $event;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="publication", type="boolean")
     */
    private $publication;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->publication = false;
    }

    /**
     * Set desciptif
     *
     * @param string $desciptif
     * @return Soiree
     */
    public function setDesciptif($desciptif)
    {
        $this->desciptif = $desciptif;
    
        return $this;
    }

    /**
     * Get desciptif
     *
     * @return string 
     */
    public function getDesciptif()
    {
        return $this->desciptif;
    }

    /**
     * Set dates
     *
     * @param \AppBundle\Entity\Periode $dates
     * @return Soiree
     */
    public function setDates(\AppBundle\Entity\Periode $dates = null)
    {
        $this->dates = $dates;
    
        return $this;
    }

    /**
     * Get dates
     *
     * @return \AppBundle\Entity\Periode 
     */
    public function getDates()
    {
        return $this->dates;
    }
    
    /**
     * Get start date
     *
     */
    public function getDateDebut()
    {
    	if($this->dates !== null) {
    		return $this->dates->getDateDebut();
    	}
    	return null;
    }
    
    /**
     * Get end date
     *
     */
    public function getDateFin()
    {
    	if($this->dates !== null) {
    		return $this->dates->getDateFin();
    	}
    	return null;
    }

    /**
     * Set adresse
     *
     * @param \AppBundle\Entity\Adresse $adresse
     * @return Soiree
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
     * Set publication
     *
     * @param boolean $publication
     * @return Soiree
     */
    public function setPublication($publication)
    {
        $this->publication = $publication;
    
        return $this;
    }

    /**
     * Get publication
     *
     * @return boolean 
     */
    public function getPublication()
    {
        return $this->publication;
    }

    /**
     * Set event
     *
     * @param \AppBundle\Entity\Event $event
     * @return Soiree
     */
    public function setEvent(\AppBundle\Entity\Event $event = null)
    {
        $this->event = $event;
    
        return $this;
    }

    /**
     * Get event
     *
     * @return \AppBundle\Entity\Event 
     */
    public function getEvent()
    {
        return $this->event;
    }
}