<?php

namespace AppBundle\DTO;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\MappedSuperclass;

/**
 * Abstract base class for most Getin entities.
 */
abstract class AbstractDto
{
	/**
	 * @var integer
	 */
	private $id;
	
	/**
	 * @var string
	 */
	protected $controlKey;
	
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
	 * Get id
	 *
	 * @return integer
	 */
	public function setId($id)
	{
		$this->id = $id;
		
		return $this;
	}
	
	/**
	 * Set controlKey
	 *
	 * @param boolean $controlKey
	 * @return AbstractDto
	 */
	public function setControlKey($controlKey)
	{
		$this->controlKey = $controlKey;
	
		return $this;
	}
	
	/**
	 * Get controlKey
	 *
	 * @return string
	 */
	public function getControlKey()
	{
		return $this->controlKey;
	}
	
}
