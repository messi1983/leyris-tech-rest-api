<?php
namespace AppBundle\Outils;
use AppBundle\Constants\Constants;
use AppBundle\Constants\ConstRoutes;
use AppBundle\Constants\ConstClasses;

/**
 * Routes utils class
 */
class  RouteOutils
{	
	
// 	/**
// 	 * Constructor
// 	 */
// 	private function __construct()
// 	{
// 	}
	
	/**
	 * Get the search route
	 */
	public static function getRouteSearch($entityClass)
	{
		if($entityClass === ConstClasses::CLASS_CAR_POOLING) {
			return ConstRoutes::ROUTE_LISTER_COVOITURAGES;
		} else if($entityClass ===  ConstClasses::CLASS_EVENT) {
			return ConstRoutes::ROUTE_LISTER_EVENEMENTS;
		} else if($entityClass === ConstClasses::CLASS_ACCOMMODATION) {
			return 'lmievent_lister_hebergements';
		} else if($entityClass === ConstClasses::CLASS_DANCE_SCHOOL) {
			return 'lmievent_lister_ecoles';
		} else if($entityClass === ConstClasses::CLASS_STORE) {
			return 'lmievent_lister_commerces';
		}
		return null;
	}
}
?>
