<?php
namespace AppBundle\Services;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\ResultSetMapping;
use AppBundle\Entity\Carpooling;
use AppBundle\DTO\Statistiques;
use AppBundle\DTO\CarpoolingDto;
use AppBundle\Constants\ConstClasses;
use AppBundle\Form\CarpoolingType;
use AppBundle\Constants\ConstParamAttributs;
use AppBundle\Outils\DateOutils;
use Doctrine\ORM\Tools\Pagination\Paginator;
use AppBundle\Constants\Constants;

/**
 * Carpooling service class
 */
class CarpoolingService extends AbsService
{
	const NB_COV_NON_COMPLETS = "nbCovNonComplets";
	
	const NB_PLACES_DISPONIBLES = "nbPlacesDisponibles";
	
	const PRIX_MOYEN = "prixMoyen";
	
	/**
	 * Constructor
	 */
	public function __construct(EntityManager $em)
	{
		parent::__construct($em);
	}
	
	/**
	 * Find carpoolings from an interval of date and route
	 * @param unknown $trajet
	 * @param unknown $dateTimesInterval
	 * @param unknown $page
	 * @return array
	 */
	public function countCpForEachDepartureDate($trajet, $datesInterval)
	{
		$currentDate = new \DateTime($datesInterval[0]->format(Constants::DATE_TIME_FORMAT));
		$maxDate = new \DateTime($datesInterval[1]->format(Constants::DATE_TIME_FORMAT));
		$result = array();
		
		while($currentDate <= $maxDate) {
			$result[$currentDate->format(Constants::DEFAULT_DATE_FORMAT)] = array('nbDepart' => 0);
			$currentDate->add(new \DateInterval('P1D'));
		}
		
		$nbCpForEachDepartureDate = $this->getLinkedRepository()->countCpForEachDepartureDate($trajet, $datesInterval);
		
		foreach($nbCpForEachDepartureDate as $item) {
			$result[$item['date']] = $item;
		}
		
		return $result;
	}
	
	/**
	 * Find carpoolings from an interval datetime and route
	 * @param unknown $trajet
	 * @param unknown $dateTimesInterval
	 * @param unknown $page
	 * @return array
	 */
	public function findByRouteAndDatetimesInterval($trajet, $dateTimesInterval, $page)
	{
		return $this->getLinkedRepository()->findByRouteAndDatetimesInterval($trajet, $dateTimesInterval, $page);
	}
	
	public function getStats($trajet, $datetime)
	{
		$listeCarpoolings = $this->getLinkedRepository()->findFromDatetime($trajet->getVilleDepart(), $trajet->getVilleArrivee(), $datetime, true);
		
		$stats = $this->createAndInitTabNbCovNonComplets();
		$stats = $this->fillStatsTab($stats, $listeCarpoolings);
		$stats = $this->calculateAveragePrice($stats);
	
		return $stats;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \AppBundle\Services\AbsService::createNewEntity()
	 */
	public function createNewEntity()
	{
		return new Carpooling();
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \AppBundle\Services\AbsService::getFormClass()
	 */
	public function getFormClass()
	{
		return CarpoolingType::class;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \AppBundle\Services\AbstractService::getLinkedRepository()
	 */
	protected function getLinkedRepository()
	{
		return $this->em->getRepository(ConstClasses::CLASS_CAR_POOLING);
	}
	
	private function calculateAveragePrice($stats)
	{
		for($i = 0; $i < 24; $i++) {
			foreach($this->buildTabHeuresDepart($i) as $heureDepart) {
				$keysValuesTab = &$stats[$heureDepart];
				$keysValuesTab[$this::PRIX_MOYEN] = $keysValuesTab[$this::PRIX_MOYEN] / max(1, $keysValuesTab[$this::NB_COV_NON_COMPLETS]);
			}
		}
		return $stats;
	}
	
	private function fillStatsTab($stats, $listeCarpoolings)
	{
		foreach($listeCarpoolings as $carpooling) {
			if(!$carpooling->isComplete()){
				$heureDepart = $carpooling->getHeureDepart();
				$keysValuesTab = &$stats[$heureDepart];
	
				$keysValuesTab[$this::NB_COV_NON_COMPLETS] = $keysValuesTab[$this::NB_COV_NON_COMPLETS] + 1;
				$keysValuesTab[$this::NB_PLACES_DISPONIBLES] = $keysValuesTab[$this::NB_PLACES_DISPONIBLES] + $carpooling->getNbPlacesRestantes();
				$keysValuesTab[$this::PRIX_MOYEN] = $keysValuesTab[$this::PRIX_MOYEN] + $carpooling->getPrice();
			}
		}
		return $stats;
	}
	
	private function createAndInitTabNbCovNonComplets()
	{
		$tabNbCovNonComplets = array();
		for($i = 0; $i < 24; $i++) {
			foreach($this->buildTabHeuresDepart($i) as $heureDepart) {
				$tabNbCovNonComplets[$heureDepart] = [$this::NB_COV_NON_COMPLETS => 0, $this::NB_PLACES_DISPONIBLES => 0, $this::PRIX_MOYEN => 0];
			}
		}
		return $tabNbCovNonComplets;
	}
	
	private function buildTabHeuresDepart($i)
	{
		$tabHeuresDepart = null;
		if($i < 10) {
			$tabHeuresDepart = ['0'.$i.':00', '0'.$i.':15', '0'.$i.':30', '0'.$i.':45'];
		} else {
			$tabHeuresDepart = [$i.''.':00', $i.''.':15', $i.''.':30', $i.''.':45'];
		}
		return $tabHeuresDepart;
	}
}
?>
