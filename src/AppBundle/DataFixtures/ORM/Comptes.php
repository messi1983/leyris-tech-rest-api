<?php
namespace AppBundle\DataFixtures\ORM;
 
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use AppBundle\Constants\ConstClasses;
use AppBundle\DataFixtures\Outils\DataFixureOutils;
 
class Comptes extends AbstractDataFixure implements OrderedFixtureInterface
{
	private $cp_Bx_Tlse, $cp_Bx_Lyon, $cp_Bx_Niort, $cp_Nantes_Tlse;
	
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
	parent::load($manager);
	
  	$this->loadUsers();
  	$this->loadCarpoolings();
  	
  	//=======================================================================
  	// Comptes
  	//=======================================================================
  	$compteMarion = DataFixureOutils::createCompte($this->userMarion, [$this->userChaput, $this->userLP]);
  	$compteManu = DataFixureOutils::createCompte($this->userManu, [$this->userLP]);
  	$compteLP = DataFixureOutils::createCompte($this->userLP, [$this->userChaput]);
  	
  	$this->persist([$compteMarion, $compteManu, $compteLP]);
  	
  }
  
  /* (non-PHPdoc)
   * @see \Doctrine\Common\DataFixtures\OrderedFixtureInterface::getOrder()
   */
  public function getOrder() {
  	return 5;
  }
  
  protected function loadCarpoolings()
  {
  	$listeCarpoolings = $this->em->getRepository(ConstClasses::CLASS_CAR_POOLING)->findAll();
  
  	$this->cp_Bx_Tlse = DataFixureOutils::findCarpooling('Bordeaux', 'Toulouse', $listeCarpoolings);
  	$this->cp_Bx_Lyon = DataFixureOutils::findCarpooling('Bordeaux', 'Lyon', $listeCarpoolings);
  	$this->cp_Bx_Niort = DataFixureOutils::findCarpooling('Bordeaux', 'Niort', $listeCarpoolings);
  	$this->cp_Nantes_Tlse = DataFixureOutils::findCarpooling('Nantes', 'Toulouse', $listeCarpoolings);
  }
}
?>