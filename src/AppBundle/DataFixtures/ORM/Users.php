<?php
namespace AppBundle\DataFixtures\ORM;
 
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use AppBundle\DataFixtures\Outils\DataFixureOutils;
 
class Users extends AbstractDataFixure  implements OrderedFixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
  	parent::load($manager);
  	
  	//=======================================================================
  	// Users
  	//=======================================================================
  	$userMarion = DataFixureOutils::createUser('Marion', 'marion.louis@yahoo.fr', 'marion');
  	$userManu = DataFixureOutils::createUser('Manuel', 'manuel.louis@yahoo.fr', 'manuel');
  	$userChaput = DataFixureOutils::createUser('Chapute', 'chapute.louis@yahoo.fr', 'chapute');
  	$userLP = DataFixureOutils::createUser('LEPIOUF', 'lpiouf2.louis@yahoo.fr', 'lepiouf2');
  	
  	$this->persist([$userMarion, $userManu, $userChaput, $userLP]);
  }
  
	/* (non-PHPdoc)
	 * @see \Doctrine\Common\DataFixtures\OrderedFixtureInterface::getOrder()
	 */
	public function getOrder() {
		return 1;
	}
	
}
?>