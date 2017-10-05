<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Accommodation
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\AccommodationRepository")
 */
class Accommodation extends AbstractPulishedEntity
{
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="nbPlaces", type="integer")
	 */
	private $nbPlaces;
    
    /**
     * @ORM\Embedded(class = "AppBundle\Entity\Periode")
     */
    private $periode;
    
     /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=75, nullable=true)
     */
    private $type;
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="accommodations", cascade={"persist", "merge"})
     */
    private $host;
    
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User", cascade={"persist", "remove"})
     */
    private $tenants;
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Adresse", cascade={"persist", "remove"})
     */
    private $adresse;
    
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Event", inversedBy="hebergements")
     * @ORM\JoinTable(name="event_accommodation")
     */
    private $events;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Set type
     *
     * @param string $type
     * @return Accommodation
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set periode
     *
     * @param \AppBundle\Entity\Periode $periode
     * @return Accommodation
     */
    public function setPeriode(\AppBundle\Entity\Periode $periode = null)
    {
        $this->periode = $periode;
    
        return $this;
    }

    /**
     * Get periode
     *
     * @return \AppBundle\Entity\Periode 
     */
    public function getPeriode()
    {
        return $this->periode;
    }

    /**
     * Set adresse
     *
     * @param \AppBundle\Entity\Adresse $adresse
     * @return Accommodation
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
     * Set nbPlaces
     *
     * @param integer $nbPlaces
     * @return Accommodation
     */
    public function setNbPlaces($nbPlaces)
    {
        $this->nbPlaces = $nbPlaces;
    
        return $this;
    }

    /**
     * Get nbPlaces
     *
     * @return integer 
     */
    public function getNbPlaces()
    {
        return $this->nbPlaces;
    }

    /**
     * Set host
     *
     * @param \AppBundle\Entity\User $host
     * @return Accommodation
     */
    public function setHost(\AppBundle\Entity\User $host = null)
    {
        $this->host = $host;
    
        return $this;
    }

    /**
     * Get host
     *
     * @return \AppBundle\Entity\User 
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Add tenants
     *
     * @param \AppBundle\Entity\User $tenant
     * @return Accommodation
     */
    public function addTenant(\AppBundle\Entity\User $tenant)
    {
        $this->tenants[] = $tenant;
    
        return $this;
    }

    /**
     * Remove tenants
     *
     * @param \AppBundle\Entity\User $tenant
     */
    public function removeTenant(\AppBundle\Entity\User $tenant)
    {
        $this->tenants->removeElement($tenant);
    }
    
    /**
     * Get tenants
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTenants()
    {
        return $this->tenants;
    }

    /**
     * Add event
     *
     * @param \AppBundle\Entity\Event $event
     * @return Accommodation
     */
    public function addEvent(\AppBundle\Entity\Event $event)
    {
        $this->events[] = $event;
    
        return $this;
    }

    /**
     * Remove event
     *
     * @param \AppBundle\Entity\Event $event
     */
    public function removeEvent(\AppBundle\Entity\Event $event)
    {
        $this->events->removeElement($event);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvents()
    {
        return $this->events;
    }
}