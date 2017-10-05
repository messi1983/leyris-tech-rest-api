<?php
namespace AppBundle\Services;
use Doctrine\ORM\EntityManager;
use AppBundle\Constants\Constants;
use AppBundle\Constants\ConstParamAttributs;
use AppBundle\Constants\ConstClasses;
use Doctrine\ORM\Query\ResultSetMapping;
use AppBundle\Outils\DateOutils;

/**
 * Abstract service class
 */
abstract class  AbsService
{	
	/**
	 * Entity manager
	 */
	protected $em;
	
	/**
	 * Constructor
	 */
	public function __construct(\Doctrine\ORM\EntityManager $em)
	{
		$this->em = $em;
	}
	
	/**
	 * Allow to return new entite
	 */
	public abstract function createNewEntity();
	
	/**
	 * Allow to return new entity form class
	 */
	public abstract function getFormClass();
	
	/**
	 * Allow to persists a bean
	 */
	public function saveOrUpdate($bean)
	{
		// Save or update
		if($bean->getId() === null) {
			$this->em->persist($bean);
		}
		$this->em->flush();
	
		return $this;
	}
	
	/**
	 * Get all entities in database
	 * @return all entities
	 */
	public function findAll()
	{
		return $this->getLinkedRepository()->findAll();
	}
	
	/**
	 * Find user by its login
	 * @param unknown $username
	 * @return object
	 */
	public function findById($id)
	{
		return $this->getLinkedRepository()->findOneBy(array('id' => $id));
	}
	
}
?>
