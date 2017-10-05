<?php
namespace AppBundle\DataFixtures\ORM;
 
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use AppBundle\Constants\ConstClasses;
use AppBundle\Entity\Periode;
use AppBundle\Outils\DateOutils;
use AppBundle\Entity\RechercheCp;
use AppBundle\Entity\Trajet;
 
class RechercheCps extends AbstractDataFixure implements OrderedFixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
	parent::load($manager);
	
  	//=======================================================================
  	// Demandes
  	//=======================================================================
	$dateTime1 = new \DateTime('2017-07-19 12:00:00', new \DateTimeZone('Europe/Paris'));
	$dateTime2 = new \DateTime('2017-07-21 14:00:00', new \DateTimeZone('Europe/Paris'));
	$dateTime3 = new \DateTime('2017-07-25 14:30:00', new \DateTimeZone('Europe/Paris'));
	
	$rech_Bx_Tlse = new RechercheCp(new Trajet("Bordeaux", "Toulouse"), new Periode($dateTime1, $dateTime2));
	$rech_Bx_lyon = new RechercheCp(new Trajet("Bordeaux", "Lyon"), new Periode($dateTime1, $dateTime3));
	$rech_Lyon_Tlse = new RechercheCp(new Trajet("Lyon", "Toulouse"), new Periode($dateTime2, $dateTime3));
  	
  	$this->persist([$rech_Bx_Tlse, $rech_Bx_lyon, $rech_Lyon_Tlse]);
  }
  
  /* (non-PHPdoc)
   * @see \Doctrine\Common\DataFixtures\OrderedFixtureInterface::getOrder()
   */
  public function getOrder() {
  	return 6;
  }
  
}
?>