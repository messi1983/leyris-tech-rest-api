<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Criteria;

/**
 * OffreCp
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\OffreCpRepository")
 */
class OffreCp
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
	 * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Compte", cascade={"persist", "merge"}, mappedBy="offreCpRecues")
	 */
	private $destinataires;
	
	/**
	 * @ORM\OneToOne(targetEntity="AppBundle\Entity\Carpooling", mappedBy="offreEmise")
	 */
	private $carpooling;
    
	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="dateValidite", type="datetime")
	 */
	private $dateValidite;
    
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
        $this->destinataires = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set dateValidite
     *
     * @param \DateTime $dateValidite
     *
     * @return OffreCp
     */
    public function setDateValidite($dateValidite)
    {
        $this->dateValidite = $dateValidite;

        return $this;
    }

    /**
     * Get dateValidite
     *
     * @return \DateTime
     */
    public function getDateValidite()
    {
        return $this->dateValidite;
    }

    /**
     * Add destinataire
     *
     * @param \AppBundle\Entity\Compte $destinataire
     *
     * @return OffreCp
     */
    public function addDestinataire(\AppBundle\Entity\Compte $destinataire)
    {
    	$destinataire->addOffreCpRecue($this);
        $this->destinataires[] = $destinataire;

        return $this;
    }

    /**
     * Remove destinataire
     *
     * @param \AppBundle\Entity\Compte $destinataire
     */
    public function removeDestinataire(\AppBundle\Entity\Compte $destinataire)
    {
        $this->destinataires->removeElement($destinataire);
    }

    /**
     * Get destinataires
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDestinataires()
    {
        return $this->destinataires;
    }

    /**
     * Set carpooling
     *
     * @param \AppBundle\Entity\Carpooling $carpooling
     *
     * @return OffreCp
     */
    public function setCarpooling(\AppBundle\Entity\Carpooling $carpooling = null)
    {
        $this->carpooling = $carpooling;

        return $this;
    }

    /**
     * Get carpooling
     *
     * @return \AppBundle\Entity\Carpooling
     */
    public function getCarpooling()
    {
        return $this->carpooling;
    }
}
