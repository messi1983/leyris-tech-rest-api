<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest; 
use AppBundle\Entity\User;
use AppBundle\Constants\ConstServices;
use AppBundle\Constants\ConstClasses;
use AppBundle\Form\UserInfosType;
use AppBundle\Form\UserType;
use AppBundle\Services\UserService;
use AppBundle\Services\DtoToParameterBagConverter;

class UserController extends AbstractController
{
	/**
	 * @Rest\View()
	 * @Rest\Get("/user/{id}", name="_user")
	 */
	public function findAction(Request $request)
	{
		return $this->findById($request->get('id'));
	}
	
	/**
	 * @Rest\View()
	 * @Rest\Patch("/user/update/{id}", name="_user")
	 */
	public function updateAction(Request $request)
	{
		return $this->createOrUpdate($request, false);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \AppBundle\Controller\AbstractController::getLinkedServiceName()
	 */
	protected function getLinkedServiceName()
	{
		return ConstServices::SERVICE_USER;
	}
	
}
?>
