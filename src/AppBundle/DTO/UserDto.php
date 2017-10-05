<?php

namespace AppBundle\DTO;

/**
 * UserDto
 */
class UserDto extends AbstractDto
{
	/**
	 * @var integer $lastname
	 */
	private $compteId;
	
	/**
	 * @var string $lastname
	 */
	private $lastname;
	
	/**
	 * @var string $firstname
	 */
	private $firstname;
	
	/**
	 * @var string
	 */
	private $sexe;
	
// 	private $telephone;
	
	/**
	 * Set compteId
	 *
	 * @param string $compteId
	 * @return UserDto
	 */
	public function setCompteId($compteId)
	{
		$this->compteId = $compteId;
	
		return $this;
	}
	
	/**
	 * Get compteId
	 *
	 * @return string
	 */
	public function getCompteId()
	{
		return $this->compteId;
	}
	
    /**
     * Set sexe
     *
     * @param string $sexe
     * @return UserDto
     */
    public function setSexe($sexe)
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
     * Set lastname
     *
     * @param string $lastname
     * @return UserDto
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    
        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return UserDto
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    
        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }
    
}