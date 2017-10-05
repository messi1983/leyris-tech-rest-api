<?php
namespace AppBundle\Services;
use Doctrine\ORM\EntityManager;
use AppBundle\Constants\Constants;
use Doctrine\ORM\Query\ResultSetMapping;
use AppBundle\Constants\ConstClasses;
use AppBundle\Entity\Compte;
use AppBundle\Entity\ReservationCp;
use AppBundle\Form\ReservationCpType;

/**
 * ReservationCpService service class
 */
class ReservationCpService extends AbsService
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
		return new ReservationCp();
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \AppBundle\Services\AbsService::getFormClass()
	 */
	public function getFormClass()
	{
		return ReservationCpType::class;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \AppBundle\Services\AbstractService::getLinkedRepository()
	 */
	protected function getLinkedRepository()
	{
		return $this->em->getRepository(ConstClasses::CLASS_RESERVATION_CP);
	}
}
?>
