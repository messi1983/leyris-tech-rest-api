<?php
namespace AppBundle\DataFixtures\ORM;
 
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use AppBundle\Constants\ConstClasses;
use Doctrine\Common\DataFixtures\AbstractFixture;
use AppBundle\DataFixtures\Outils\DataFixureOutils;
 
class Events extends AbstractDataFixure implements OrderedFixtureInterface
{
// 	private  $p2016, $pFiniDans2h, $pDebutDans2h, $pDebutDemain, $pDebutDans10j;
	
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
	parent::load($manager);
	
//   	$this->loadPeriodes();
  	
  	//=======================================================================
  	// events
  	//=======================================================================
  	$event1 = DataFixureOutils::createEvent('Evenement avorte', [], []);
  	$event2 = DataFixureOutils::createEvent('Soiree Pizza fini dans 2h', [], []);
  	 
  	$this->persist([$event1, $event2]);
  }
  
  /* (non-PHPdoc)
   * @see \Doctrine\Common\DataFixtures\OrderedFixtureInterface::getOrder()
   */
  public function getOrder() {
  	return 3;
  }
  
  
//   private function loadPeriodes()
//   {
//   	$listePeriodes = $this->em->getRepository(ConstClasses::CLASS_PERIODE)->findAll();
  	
//   	$this->p2016 = TestOutils::findPeriode(TestOutils::createPastPeriode('2016-01-10','2016-12-10'), $listePeriodes);
//   	$this->pFiniDans2h = TestOutils::findPeriode(TestOutils::createCurrentPeriode('P1D', 'PT2H'), $listePeriodes);
//   	$this->pDebutDans2h = TestOutils::findPeriode(TestOutils::createFuturPeriode('PT2H', 'PT6H'), $listePeriodes);
//   	$this->pDebutDemain = TestOutils::findPeriode(TestOutils::createFuturPeriode('P1D', 'P1DT6H'), $listePeriodes);
//   	$this->pDebutDans10j = TestOutils::findPeriode(TestOutils::createFuturPeriode('P10D', 'P10DT6H'), $listePeriodes);
//   }
  
}
?>