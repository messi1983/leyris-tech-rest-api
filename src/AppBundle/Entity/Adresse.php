<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Constants\Constants;

/**
 * Adresse
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\AdresseRepository")
 */
class Adresse
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
     * @var integer
     *
     * @ORM\Column(name="numero", type="integer")
     */
    private $numero;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="bis", type="boolean", nullable=true)
     */
    private $bis;
    
    /**
     * @var string
     *
     * @ORM\Column(name="rue", type="text")
     */
    private $rue;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="codePostal", type="integer")
     */
    private $codePostal;
    
    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="text")
     */
    private $ville;

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
     * Set adresse
     *
     * @param string $adresse
     * @return Adresse
     */
    public function setRue($rue)
    {
    	$this->rue = $rue;
    
    	return $this;
    }
    
    /**
     * Get rue
     *
     * @return string
     */
    public function getRue()
    {
    	return $this->rue;
    }
    
    /**
     * Set numero
     *
     * @param integer $numero
     * @return Ecole
     */
    public function setNumero($numero)
    {
    	$this->numero = $numero;
    
    	return $this;
    }
    
    /**
     * Get numero
     *
     * @return integer
     */
    public function getNumero()
    {
    	return $this->numero;
    }
    
    /**
     * Set bis
     *
     * @param boolean $bis
     * @return Ecole
     */
    public function setBis($bis)
    {
    	$this->bis = $bis;
    
    	return $this;
    }
    
    /**
     * Get bis
     *
     * @return boolean
     */
    public function getBis()
    {
    	return $this->bis;
    }
    
    /**
     * Set codePostal
     *
     * @param integer $codePostal
     * @return Ecole
     */
    public function setCodePostal($codePostal)
    {
    	$this->codePostal = $codePostal;
    
    	return $this;
    }
    
    /**
     * Get codePostal
     *
     * @return integer
     */
    public function getCodePostal()
    {
    	return $this->codePostal;
    }
    
    /**
     * Set ville
     *
     * @param string $ville
     * @return Ecole
     */
    public function setVille($ville)
    {
    	$this->ville = $ville;
    
    	return $this;
    }
    
    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
    	return $this->ville;
    }
    
    /**
     * Get complete adresse
     *@return string
     */
    public function getInStringFormat()
    {
    	if($this->adresse != null) {
    		 
    		if($this->bis != null) {
    			return $this->numero.' bis '.$this->adresse.', '.$this->codePostal.' '.$this->ville;
    		} else {
    			return $this->numero.' '.$this->adresse.', '.$this->codePostal.' '.$this->ville;
    		}
    	}
    	return Constants::EMPTY_STRING;
    }
}
