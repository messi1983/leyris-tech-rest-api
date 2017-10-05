<?php
namespace AppBundle\DataFixtures\ORM;
 
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use AppBundle\Tests\DataFixureOutils;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use AppBundle\Constants\ConstClasses;
use Doctrine\Common\DataFixtures\AbstractFixture;
 
abstract class AbstractDataFixure extends AbstractFixture
{
	protected $encoder;
	protected $em;
	protected $userMarion, $userManu, $userChaput, $userLP;
	
	
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
  	$this->encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
  	$this->em = $manager;
  	
  }
  
  protected function persist($beans)
  {
  	foreach ($beans as $bean) {
  		$this->em->persist($bean);
  	}
  	$this->em->flush();
  }
  
  protected function loadUsers()
  {
  	$listeUsers = $this->em->getRepository(ConstClasses::CLASS_USER)->findAll();
  	 
  	$this->userMarion = DataFixureOutils::findUser("Marion", $listeUsers);
  	$this->userManu = DataFixureOutils::findUser("Manuel", $listeUsers);
  	$this->userChaput = DataFixureOutils::findUser("Chapute", $listeUsers);
  	$this->userLP = DataFixureOutils::findUser("LEPIOUF", $listeUsers);
  }
  
}
?>