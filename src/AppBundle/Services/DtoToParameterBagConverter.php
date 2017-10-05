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
use AppBundle\Entity\Trajet;

/**
 * Mapper class
 */
class DtoToParameterBagConverter
{
	public static function convertDtoInBagParams($dto)
	{
		if($dto instanceof CarpoolingDto) {
			return static::convertCarpoolingDtoInBagParams($dto);
		}
		if($dto instanceof UserDto) {
			return static::convertUserDtoInBagParams($dto);
		}
		if($dto instanceof TrajetDto) {
			return static::convertTrajetDtoInBagParams($dto);
		}
		if($dto instanceof ReservationCpDto) {
			return static::convertReservationCpDtoInBagParams($dto);
		}
		return null;
	}
	
	public static function convertCarpoolingDtoInBagParams(\AppBundle\DTO\CarpoolingDto $dto)
	{
		$params = array();
	
		if($dto->getId() !== null) {
			$params['id'] = $dto->getId();
		}
		if($dto->getPrice() !== null) {
			$params['price'] = $dto->getPrice();
		}
		if($dto->getNbPlacesRestantes() !== null) {
			$params['nbPlacesRestantes'] = $dto->getNbPlacesRestantes();
		}
		if($dto->getDateRetour() !== null) {
			$params['dateRetour'] = $dto->getDateRetour()->format(Constants::DATE_TIME_FORMAT);
		}
		if($dto->getDateDepart() !== null) {
			$params['dateDepart'] = $dto->getDateDepart()->format(Constants::DATE_TIME_FORMAT);
		}
		if($dto->getTrajet() !== null) {
			$params['trajet'] = DtoToParameterBagConverter::convertTrajetDtoInBagParams($dto->getTrajet());
		}
		if($dto->isAllerRetour() !== null) {
			$params['allerRetour'] = $dto->isAllerRetour();
		}
		if($dto->getComment() !== null) {
			$params['comment'] = $dto->getComment();
		}
		if($dto->isAcceptationAuto() !== null) {
			$params['acceptationAuto'] = $dto->isAcceptationAuto();
		}
	
		return $params;
	}
	
	public static function convertTrajetDtoInBagParams(\AppBundle\DTO\TrajetDto $dto)
	{
		$params = array();
	
		if($dto->getVilleArrivee() !== null) {
			$params['villeArrivee'] = $dto->getVilleArrivee();
		}
		if($dto->getVilleDepart() !== null) {
			$params['villeDepart'] = $dto->getVilleDepart();
		}
		if($dto->getPointArrivee() !== null) {
			$params['pointArrivee'] = $dto->getPointArrivee();
		}
		if($dto->getPointDepart() !== null) {
			$params['pointDepart'] = $dto->getPointDepart();
		}
		
		return $params;
	}
	
	public static function  convertUserDtoInBagParams(\AppBundle\DTO\UserDto $dto)
	{
		$params = array();
	
		if($dto->getLastname() !== null) {
			$params['lastname'] = $dto->getLastname();
		}
		if($dto->getFirstname() !== null) {
			$params['firstname'] = $dto->getFirstname();
		}
		if($dto->getSexe() !== null) {
			$params['sexe'] = $dto->getSexe();
		}
	
		return $params;
	}
	
	public static function convertReservationCpDtoInBagParams(\AppBundle\DTO\ReservationCpDto $dto)
	{
		$params = array();
	
		if($dto->getId() !== null) {
			$params['id'] = $dto->getId();
		}
		if($dto->getDate() !== null) {
			$params['date'] = $dto->getDate()->format(Constants::DATE_TIME_FORMAT);
		}
		if($dto->getEtat() !== null) {
			$params['etat'] = $dto->getEtat();
		}
		if($dto->getMultiGroupe() !== null) {
			$params['multiGroupe'] = $dto->getMultiGroupe();
		}
		if($dto->getNbPlaces() !== null) {
			$params['nbPlaces'] = $dto->getNbPlaces();
		}
	
		return $params;
	}
}
?>
