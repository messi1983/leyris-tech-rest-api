<?php
namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use AppBundle\Entity\User;
use AppBundle\Constants\Constants;
use AppBundle\Constants\ConstClasses;
use AppBundle\Form\UserType;

/**
 * User service class
 */
class UserService extends AbsService
{
	
	/**
	 * Constructor
	 */
	public function __construct(EntityManager $em)
	{
		parent::__construct($em);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \AppBundle\Services\AbsService::createNewEntity()
	 */
	public function createNewEntity()
	{
		return new User();
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \AppBundle\Services\AbsService::getFormClass()
	 */
	public function getFormClass()
	{
		return UserType::class;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \AppBundle\Services\AbstractService::getLinkedRepository()
	 */
	protected function getLinkedRepository()
	{
		return $this->em->getRepository(ConstClasses::CLASS_USER);
	}
	
}
?>

