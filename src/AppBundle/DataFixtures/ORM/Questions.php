<?php
namespace AppBundle\DataFixtures\ORM;
 
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use AppBundle\Constants\ConstClasses;
use Doctrine\Common\DataFixtures\AbstractFixture;
use AppBundle\DataFixtures\Outils\DataFixureOutils;
 
class Questions extends AbstractDataFixure implements OrderedFixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
	parent::load($manager);
	
  	//=======================================================================
  	// questions/reponses
  	//=======================================================================
  	$q1 = DataFixureOutils::createQuestion('Pouvez vous me prendre à la sortie 6?', 'Jeanne', 'Pas de problème! A de suite');
  	$q2 = DataFixureOutils::createQuestion("J'ai deux petites sacs. Ca passe?", 'Christophe', 'Pas de problème! A de suite');
  	$q3 = DataFixureOutils::createQuestion("Tu passes par Agen ?", 'Christophe', 'Pas de problème! A de suite');
  	 
  	$this->persist([$q1, $q2, $q3]);
  	
  }
  
  /* (non-PHPdoc)
   * @see \Doctrine\Common\DataFixtures\OrderedFixtureInterface::getOrder()
   */
  public function getOrder() {
  	return 2;
  }
  
}
?>