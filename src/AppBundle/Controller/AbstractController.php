<?php
namespace AppBundle\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Constants\Constants;
use AppBundle\Constants\ConstServices;
use AppBundle\Constants\ConstParamAttributs;
use AppBundle\Entity\Carpooling;
use AppBundle\Outils\RouteOutils;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Services\EntityToDtoConverter;
use AppBundle\Services\DtoToParameterBagConverter;
use AppBundle\Entity\ReservationCp;
 
abstract class AbstractController extends Controller
{
	protected function createOrUpdate(Request $request, $clearMissing)
	{
		if($this->controlRequest($request)) {
			$dto = $request->request->get('dto');
			$entite = $this->findOrCreateNewEntity($request);
			$form = $this->createAndSubmitForm($dto, $entite, $clearMissing);
			
			if ($form->isValid()) {
				$this->getLinkedService()->saveOrUpdate($entite);
				return EntityToDtoConverter::convertEntityInDto($entite);
			}
			return new JsonResponse(['message' => 'Entity not valid'], Response::HTTP_EXPECTATION_FAILED);
		}
		return new JsonResponse(['message' => 'Request sender not identified'], Response::HTTP_EXPECTATION_FAILED);
	}
	
	protected function reserve(Request $request, $typeReservation)
	{
		if($this->controlRequest($request)) {
			$dto = $request->request->get('dto');
			$entite = $this->getLinkedService()->createNewEntity();
			$form = $this->createAndSubmitForm($dto, $entite, true);
			
			if ($form->isValid()) {
				return $this->saveReservation($dto, $typeReservation, $entite);
			}
			return new JsonResponse(['message' => 'Entity not valid'], Response::HTTP_EXPECTATION_FAILED);
		}
		return new JsonResponse(['message' => 'Request sender not identified'], Response::HTTP_EXPECTATION_FAILED);
	}
	
	protected function reserveMoreThanOne(Request $request, $typeReservation)
	{
		if($this->controlRequest($request)) {
			$dtos = $request->request->get('dto');
			$result = array();
			
			foreach($dtos->getListDtos() as $dto) {
				$entite = $this->getLinkedService()->createNewEntity();
				$form = $this->createAndSubmitForm($dto, $entite, true);
				
				if ($form->isValid()) {
					$result[] = $this->saveReservation($dto, $typeReservation, $entite);
				} else {
					return new JsonResponse(['message' => 'Entity not valid'], Response::HTTP_EXPECTATION_FAILED);
				}
			}
			return $result;
		}
		return new JsonResponse(['message' => 'Request sender not identified'], Response::HTTP_EXPECTATION_FAILED);
	}
	
	protected function changeState(Request $request, $state)
	{
		if($this->controlRequest($request)) {
			$entite = $this->getLinkedService()->findById($request->get('id'));
			$entite->setEtat($state);
			
			$this->getLinkedService()->saveOrUpdate($entite);
// 			$this->getLinkedService()->notifyChangeCorfirmation($entite, $user, $owner);
			
			return EntityToDtoConverter::convertEntityInDto($entite);
		}
		return new JsonResponse(['message' => 'Request sender not identified'], Response::HTTP_EXPECTATION_FAILED);
	}
	
	/**
	 * Allows to find an entity from it's id
	 * @param unknown $id
	 * @return \Symfony\Component\HttpFoundation\JsonResponse|unknown
	 */
	protected function findById($id)
	{
		$entity = $this->getLinkedService()->findById($id);
	
		if (empty($entity)) {
			return new JsonResponse(['message' => 'Entity not found'], Response::HTTP_NOT_FOUND);
		}
	
		return EntityToDtoConverter::convertEntityInDto($entity);
	}
	
	/**
	 * Gets the appropriate service.
	 */
	protected function getLinkedService() {
		return $this->get($this->getLinkedServiceName());
	}
	
	/**
	 * Allow to return the linked service
	 */
	protected abstract function getLinkedServiceName();
	
	/**
	 * Create and submit form
	 * 
	 * @param Request $request
	 */
	private function createAndSubmitForm($dto, $entite, $clearMissing)
	{
		$formClass = $this->getLinkedService()->getFormClass();
		$form = $this->createForm($formClass, $entite);
		$bagParams = DtoToParameterBagConverter::convertDtoInBagParams($dto);
		$form->submit($bagParams, $clearMissing);
		
		return $form;
	}
	
	private function findOrCreateNewEntity($request)
	{
		$entite = null;
		if($request->attributes->has('id')) {
			$entite = $this->getLinkedService()->findById($request->get('id'));
		} else {
			$entite = $this->getLinkedService()->createNewEntity();
		}
		return $entite;
	}
	
	/**
	 * 
	 * @param Request $request
	 * @param unknown $typeReservation
	 * @param unknown $reservation
	 * @return unknown
	 */
	private function saveReservation($dto, $typeReservation, $reservation)
	{
		$parentEntity = null;
		if($typeReservation === 'CARPOOLING') {
			$parentEntity = $this->get(ConstServices::SERVICE_CAR_POOLING)->findById($dto->getCarpoolingId());
		}
		$compte = $this->get(ConstServices::SERVICE_COMPTE)->findById($dto->getUser()->getCompteId());
		
		if(empty($parentEntity)) {
			return new JsonResponse(['message' => 'Parent Entity not found'], Response::HTTP_NOT_FOUND);
		}
		if(empty($compte)) {
			return new JsonResponse(['message' => 'Compte Entity not found'], Response::HTTP_NOT_FOUND);
		}
		
		$reservation->setUserCompte($compte);
		$parentEntity->addReservation($reservation);
		
		$this->getLinkedService()->saveOrUpdate($reservation);
// 		$this->getLinkedService()->notifyReservation($reservation, $user);
		
		return EntityToDtoConverter::convertEntityInDto($reservation);
	}
	
	protected function controlRequest($request)
	{
		$dto = $request->request->get('dto');
		if($request->getMethod() === 'POST') {
			return !empty($dto) && $dto->getControlKey() === 'new_Entity';
		}
		$entiteId = $request->get('id');
		return !empty($dto) && !empty($entiteId) && ($dto->getControlKey() === 'cp'.$entiteId.'end');
	}
}
?>
