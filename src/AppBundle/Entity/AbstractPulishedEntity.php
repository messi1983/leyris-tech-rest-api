<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\MappedSuperclass;

/**
 * Abstract base class for most Getin entities.
 * 
 * @MappedSuperclass
 *
 */
abstract class AbstractPulishedEntity extends AbstractEntity
{
	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="publication", type="boolean")
	 */
	private $publication;
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->publication = false;
	}
	
	/**
	 * Set publication
	 *
	 * @param boolean $publication
	 * @return Danse
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
	
}
