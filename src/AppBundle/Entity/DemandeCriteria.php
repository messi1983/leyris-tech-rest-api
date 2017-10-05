<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DemandeCpDriverInfos
 * 
 * @ORM\Embeddable()
 */
class DemandeCriteria
{
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="prixMin", type="integer")
	 */
	private $prixMin;
	
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="prixMax", type="integer")
	 */
	private $prixMax;
	
    /**
     * @ORM\Column(name="receiverSexe", type="string", columnDefinition="enum('M', 'F')", nullable=true)
     */
    private $receiverSexe;
    
    /**
	 * @var integer
	 *
	 * @ORM\Column(name="receiverAgeMin", type="integer")
	 */
    private $receiverAgeMin;
    
    /**
	 * @var integer
	 *
	 * @ORM\Column(name="receiverAgeMax", type="integer")
	 */
    private $receiverAgeMax;
    
    /**
	 * @var integer
	 *
	 * @ORM\Column(name="noteMin", type="integer")
	 */
    private $noteMin;
    
     /**
	 * @var integer
	 *
	 * @ORM\Column(name="noteMax", type="integer")
	 */
    private $noteMax;
    
    /**
	 * @var boolean
	 *
	 * @ORM\Column(name="inMyContacts", type="boolean")
	 */
    private $inMyContacts;
    
    /**
     * Set state
     *
     * @param string $sexe
     * @return DemandeCriteria
     */
    public function setState($sexe)
    {
    	$this->sexe = $sexe;
    
    	return $this;
    }
    
    /**
     * Get sexe
     *
     * @return string
     */
    public function getSexe()
    {
    	return $this->sexe;
    }
    
    /**
     * Set ageMin
     *
     * @param integer $ageMin
     * @return DemandeCriteria
     */
    public function setAgeMin($ageMin)
    {
    	$this->ageMin = $ageMin;
    
    	return $this;
    }
    
    /**
     * Get ageMin
     *
     * @return integer
     */
    public function getAgeMin()
    {
    	return $this->ageMin;
    }
    
    /**
     * Set ageMax
     *
     * @param integer $ageMax
     * @return DemandeCriteria
     */
    public function setAgeMax($ageMax)
    {
    	$this->ageMax = $ageMax;
    
    	return $this;
    }
    
    /**
     * Get ageMax
     *
     * @return integer
     */
    public function getAgeMax()
    {
    	return $this->ageMax;
    }
    
    /**
     * Set noteMin
     *
     * @param integer $noteMin
     * @return DemandeCriteria
     */
    public function setNoteMin($noteMin)
    {
    	$this->noteMin = $noteMin;
    
    	return $this;
    }
    
    /**
     * Get noteMin
     *
     * @return integer
     */
    public function getNoteMin()
    {
    	return $this->noteMin;
    }
    
    /**
     * Set noteMax
     *
     * @param integer $noteMax
     * @return DemandeCriteria
     */
    public function setNoteMax($noteMax)
    {
    	$this->noteMax = $noteMax;
    
    	return $this;
    }
    
    /**
     * Get noteMax
     *
     * @return integer
     */
    public function getNoteMax()
    {
    	return $this->noteMax;
    }
    
    /**
     * Set inMyContacts
     *
     * @param boolean $inMyContacts
     * @return DemandeCriteria
     */
    public function setInMyContacts($inMyContacts)
    {
    	$this->inMyContacts = $inMyContacts;
    
    	return $this;
    }
    
    /**
     * Get inMyContacts
     *
     * @return boolean
     */
    public function isInMyContacts()
    {
    	return $this->inMyContacts;
    }
    
}