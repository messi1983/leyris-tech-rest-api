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
 
class ReservationCpController extends AbstractController
{	
	/**
	 * @Rest\View()
	 * @Rest\Post("/reservation/carpooling", name="_cp")
	 */
	public function reserveAction(Request $request)
	{
		return $this->reserve($request, 'CARPOOLING');
	}
	
	/**
	 * @Rest\View()
	 * @Rest\Put("/reservation/carpooling/cancel/{id}", name="_resv_cp")
	 */
	public function cancelAction(Request $request)
	{
		return $this->changeState($request, 'ANNULEE');
	}
	
	/**
	 * @Rest\View()
	 * @Rest\Put("/reservation/carpooling/refuse/{id}", name="_resv_cp")
	 */
	public function denialAction(Request $request)
	{
		return $this->changeState($request, 'REFUSEE');
	}
	
	/**
	 * @Rest\View()
	 * @Rest\Put("/reservation/carpooling/accept/{id}", name="_resv_cp")
	 */
	public function acceptAction(Request $request)
	{
		return $this->changeState($request, 'ACCEPTEE');
	}
	
	
	/**
	 * (non-PHPdoc)
	 * @see \AppBundle\Controller\AbstractController::getLinkedServiceName()
	 */
	protected function getLinkedServiceName()
	{
		return ConstServices::SERVICE_RESERVATION_CP;
	}
	
}
?>
