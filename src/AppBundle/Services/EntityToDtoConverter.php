<?php
namespace AppBundle\Services;
use Doctrine\ORM\EntityManager;
use AppBundle\Constants\Constants;
use Doctrine\ORM\Query\ResultSetMapping;
use AppBundle\Constants\ConstClasses;
use AppBundle\DTO\Statistiques;
use AppBundle\DTO\CarpoolingDto;
use AppBundle\DTO\TrajetDto;
use AppBundle\DTO\UserDto;
use AppBundle\DTO\ReservationCpDto;
use AppBundle\Entity\Carpooling;
use AppBundle\Entity\User;
use AppBundle\Entity\Trajet;
use AppBundle\Entity\ReservationCp;

/**
 * Mapper class
 */
class EntityToDtoConverter
{
	public static function convertEntitiesInDtos($entities)
	{
		$arrayResult = array();
		foreach ($entities as $entity) {
			$arrayResult[] = EntityToDtoConverter::convertEntityInDto($entity);
		}
		return $arrayResult;
	}
	
	public static function convertEntityInDto($entity)
	{
		if($entity instanceof Carpooling) {
			return static::convertToCarpoolingDto($entity);
		}
		if($entity instanceof User) {
			return static::convertToUserDto($entity);
		}
		if($entity instanceof Trajet) {
			return static::convertToTrajetDto($entity);
		}
		if($entity instanceof ReservationCp) {
			return static::convertToReservationCpDto($entity);
		}
		return null;
	}
	
	public static function convertToCarpoolingDto(\AppBundle\Entity\Carpooling $entity)
	{
		$dto = null;
		
		if($entity !== null) {
			$dto = new CarpoolingDto();
			
			$dto->setId($entity->getId());
			$dto->setAllerRetour($entity->getAllerRetour());
			$dto->setComment($entity->getComment());
			$dto->setDateDepart($entity->getDateDepart());
			$dto->setDateRetour($entity->getDateRetour());
			$dto->setPrice($entity->getPrice());
			$dto->setEtat($entity->getEtat());
			$dto->setNbPlacesRestantes($entity->getNbPlacesRestantes());
			
			if($entity->getDriverCompte() !== null) {
				$dto->setDriver(EntityToDtoConverter::convertToUserDto($entity->getDriverCompte()->getOwner()));
			}
			$dto->setTrajet(EntityToDtoConverter::convertToTrajetDto($entity->getTrajet()));
		}
		
		return $dto;
	}
	
	public static function convertToTrajetDto(\AppBundle\Entity\Trajet $entity = null)
	{
		$dto = null;
		
		if($entity !== null) {
			$dto = new TrajetDto();
			$dto->setPointArrivee($entity->getPointArrivee());
			$dto->setPointDepart($entity->getPointDepart());
			$dto->setVilleArrivee($entity->getVilleArrivee());
			$dto->setVilleDepart($entity->getVilleDepart());
		}
		
		return $dto;
	}
	
	public static function convertToUserDto(\AppBundle\Entity\User $entity = null)
	{
		$dto = null;
		
		if($entity !== null) {
			$dto = new UserDto();
			$dto->setId($entity->getId());
			$dto->setFirstname($entity->getFirstname());
			$dto->setLastname($entity->getLastname());
			$dto->setSexe($entity->getSexe());
		}
		return $dto;
	}
	
	public static function convertToReservationCpDto(\AppBundle\Entity\ReservationCp $entity = null)
	{
		$dto = null;
	
		if($entity !== null) {
			$dto = new ReservationCpDto();
			
// 			if($entity->getCarpooling() !== null) {
// 				$dto->setCarpoolingId($entity->getCarpooling()->getId());
// 			}
			$dto->setDate($entity->getDate());
			$dto->setEtat($entity->getEtat());
			$dto->setId($entity->getId());
			$dto->setMultiGroupe($entity->getMultiGroupe());
			$dto->setNbPlaces($entity->getNbPlaces());
			
// 			if($entity->getUserCompte() != null) {
// 				$dto->setUser(EntityToDtoConverter::convertToUserDto($entity->getUserCompte()->getOwner()));
// 			}
		}
	
		return $dto;
	}
}
?>
