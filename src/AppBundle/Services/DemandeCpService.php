<?php
namespace AppBundle\Services;
use Doctrine\ORM\EntityManager;
use AppBundle\Constants\Constants;
use Doctrine\ORM\Query\ResultSetMapping;
use AppBundle\Constants\ConstClasses;
use AppBundle\DTO\Statistiques;
use AppBundle\Entity\RechercheCp;

/**
 * DemandeCp service class
 */
class DemandeCpService extends AbsService
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
	 * Allow to return new entite
	 */
	public function createNewEntity()
	{
		return new RechercheCp(null, null);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \AppBundle\Services\AbsService::getFormClass()
	 */
	public function getFormClass()
	{
		return null;
	}
	
	/**
	 * Find carpoolings from a date and route
	 * @param unknown $villeDepart
	 * @param unknown $villeArrivee
	 * @param unknown $date
	 * @param unknown $page
	 * @param unknown $published
	 * @return NULL
	 */
	public function findByDate($trajet, $date, $page, $published)
	{
		$paginator = $this->getLinkedRepository()->findByDate($trajet->getVilleDepart(), $trajet->getVilleArrivee(), $date, $page, $published);
		
		$listCarpoolings = array();
		foreach($paginator->getIterator() as $carpooling) {
			$listCarpoolings[] = $carpooling;
		}
		
		return $listCarpoolings;
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
	 * @see \AppBundle\Services\AbstractService::getLinkedRepository()
	 */
	protected function getLinkedRepository()
	{
		return $this->em->getRepository(ConstClasses::CLASS_CAR_POOLING);
	}
	
	private function calculateAveragePrice($stats)
	{
		for($i = 0; $i < 24; $i++) {
			foreach($this->buildTabheuresDepart($i) as $heureDepart) {
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
				$keysValuesTab[$this::NB_PLACES_DISPONIBLES] = $keysValuesTab[$this::NB_PLACES_DISPONIBLES] + $carpooling->getNbPlacesDisponibles();
				$keysValuesTab[$this::PRIX_MOYEN] = $keysValuesTab[$this::PRIX_MOYEN] + $carpooling->getPrice();
			}
		}
		return $stats;
	}
	
	private function createAndInitTabNbCovNonComplets()
	{
		$tabNbCovNonComplets = array();
		for($i = 0; $i < 24; $i++) {
			foreach($this->buildTabheuresDepart($i) as $heureDepart) {
				$tabNbCovNonComplets[$heureDepart] = [$this::NB_COV_NON_COMPLETS => 0, $this::NB_PLACES_DISPONIBLES => 0, $this::PRIX_MOYEN => 0];
			}
		}
		return $tabNbCovNonComplets;
	}
	
	private function buildTabheuresDepart($i)
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
