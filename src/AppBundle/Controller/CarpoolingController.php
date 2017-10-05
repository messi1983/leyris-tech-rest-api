<?php
namespace AppBundle\Controller;
 
use AppBundle\Constants\Constants;
use AppBundle\Entity\Carpooling;
use AppBundle\Entity\User;
use AppBundle\Constants\ConstServices;
use AppBundle\Constants\ConstClasses;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Form\CarpoolingType;
use FOS\RestBundle\Controller\Annotations as Rest;
use AppBundle\DTO\CarpoolingDto;
use AppBundle\Services\EntityToDtoConverter;
use AppBundle\Services\DtoToParameterBagConverter;
use AppBundle\Entity\ReservationCp;
use AppBundle\Form\ReservationCpType;
use AppBundle\DTO\ResultatRechercheCpDto;
use AppBundle\Entity\Trajet;
use AppBundle\Constants\ConstParamAttributs;
use AppBundle\DTO\ResultatRechercheCpOnDatesIntervalDto;
 
class CarpoolingController extends AbstractController
{	
	/**
	 * @Rest\View()
	 * @Rest\Get("/carpooling/search/date/periode", name="_cp")
	 */
	public function searchOnDatePeriodAction(Request $request)
	{
		$dateMin = new \DateTime($request->query->get('dtMin'));
		$dateMax = new \DateTime($request->query->get('dtMax'));
		$datesInterval = [$dateMin, $dateMax];
		
		$villeDepart = $request->query->get('vDep');
		$villeArrivee = $request->query->get('vArr');
		$trajet = new Trajet($villeDepart, $villeArrivee);
	
		$nbCpForEachDepartureDate = $this->getLinkedService()->countCpForEachDepartureDate($trajet, $datesInterval);
		
		$mainDate = $request->query->get('date');
		$datesInterval = [new \DateTime($mainDate.' 00:00:00'), new \DateTime($mainDate.' 23:59:59')];
		
		$paginator = $this->getLinkedService()->findByRouteAndDatetimesInterval($trajet, $datesInterval, 1);
		
		$cpDtos = EntityToDtoConverter::convertEntitiesInDtos($paginator->getIterator()->getArrayCopy());
		$nbCpForEachDepartureDate[$mainDate]['carpoolings'] = $cpDtos;
		
		$fDto = new ResultatRechercheCpOnDatesIntervalDto($trajet, $datesInterval, $mainDate, $nbCpForEachDepartureDate);
		
		fwrite(STDERR, print_r($fDto, TRUE));
		
		return $fDto;
	}
	
	/**
	 * @Rest\View()
	 * @Rest\Get("/carpooling/search/datetime/periode", name="_cp")
	 */
	public function searchOnDatetimePeriodAction(Request $request)
	{
		$trajet = new Trajet($request->query->get('vDep'), $request->query->get('vArr'));
		$page = $request->query->get('p');
		$dateTimesInterval = [new \DateTime($request->query->get('dtMin')), new \DateTime($request->query->get('dtMax'))];
		
		$paginator = $this->getLinkedService()->findByRouteAndDatetimesInterval($trajet, $dateTimesInterval, $page);
		$nbPages = ceil($paginator->count()/ConstParamAttributs::ATTR_NB_ELMT_BY_PAGE);
		
		return new ResultatRechercheCpDto($trajet, $dateTimesInterval, $page, $paginator->getIterator()->getArrayCopy(), $nbPages);
	}
	
	/**
	 * @Rest\View()
	 * @Rest\Post("/carpooling/create", name="_cp")
	 */
	public function createAction(Request $request)
	{
		return $this->createOrUpdate($request, true);
	}
	
	/**
	 * @Rest\View()
	 * @Rest\Patch("/carpooling/update/{id}", name="_cp")
	 */
	public function updateAction(Request $request)
	{
		return $this->createOrUpdate($request, false);
	}
	
	/**
	 * @Rest\View()
	 * @Rest\Put("/carpooling/cancel/{id}", name="_cp")
	 */
	public function cancelAction(Request $request)
	{
		return $this->changeState($request, 'ANNULE');
	}
	
	/**
	 * @Rest\View()
	 * @Rest\Get("/carpooling/{id}", name="_cp")
	 */
	public function findAction(Request $request)
	{
		return $this->findById($request->get('id'));
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \AppBundle\Controller\AbstractController::getLinkedServiceName()
	 */
	protected function getLinkedServiceName()
	{
		return ConstServices::SERVICE_CAR_POOLING;
	}
	
}
?>
