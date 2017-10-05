<?php
namespace AppBundle\DataFixtures\ORM;
 
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use AppBundle\Constants\ConstClasses;
use AppBundle\Entity\Trajet;
use AppBundle\Entity\RestrictionCp;
use AppBundle\DataFixtures\Outils\DataFixureOutils;
 
class Carpoolings extends AbstractDataFixure implements OrderedFixtureInterface
{
	private $q1, $q2, $q3;
	
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
	parent::load($manager);
	
  	$this->loadUsers();	
  	$this->loadQuestions();
  	
  	$dateDepartParisMarseille1 = new \DateTime('2017-07-02 10:00:00', new \DateTimeZone('Europe/Paris'));
  	$dateDepartParisMarseille2 = new \DateTime('2017-07-02 12:00:00', new \DateTimeZone('Europe/Paris'));
  	$dateDepartParisMarseille3 = new \DateTime('2017-07-02 14:00:00', new \DateTimeZone('Europe/Paris'));
  	
  	$dateDepartBxLyon = new \DateTime('2017-07-02 14:00:00', new \DateTimeZone('Europe/Paris'));
  	$dateDepartBxNiort = new \DateTime('2017-07-02 10:00:00', new \DateTimeZone('Europe/Paris'));
  	$dateDepartBxTlse = new \DateTime('2017-07-02 10:00:00', new \DateTimeZone('Europe/Paris'));
  	
  	$dateDepartNantesTlse = new \DateTime('2017-07-02 14:00:00', new \DateTimeZone('Europe/Paris'));
  	 
  	$dateValiditeOffreParisMarseille1 = new \DateTime('2017-07-02 16:00:00', new \DateTimeZone('Europe/Paris'));
  	$dateValiditeOffreParisMarseille2 = new \DateTime('2020-07-02 09:00:00', new \DateTimeZone('Europe/Paris'));
  	 
  	//=======================================================================
  	// Offres
  	//=======================================================================
  	$offreParisMarseille1 = new RestrictionCp();
  	$offreParisMarseille1->setDateValidite($dateValiditeOffreParisMarseille1);
  	
  	$offreParisMarseille2 = new RestrictionCp();
  	$offreParisMarseille2->setDateValidite($dateValiditeOffreParisMarseille2);
  	
  	//=======================================================================
  	// trajets
  	//=======================================================================
  	$tr_Bx_Tlse = new Trajet('Bordeaux', 'Toulouse');
  	$tr_Bx_Lyon = new Trajet('Bordeaux', 'Lyon');
  	$tr_Bx_Niort = new Trajet('Bordeaux', 'Niort');
  	$tr_Nantes_Tlse = new Trajet('Nantes', 'Toulouse');
  	$tr_Paris_Marseille = new Trajet('Paris', 'Marseille');
  	
  	//=======================================================================
  	// Covoiturages
  	//=======================================================================
  	$covBxTlse = DataFixureOutils::createCarPooling($dateDepartBxTlse, null, $tr_Bx_Tlse, null, 17, null);
  	$covBxNiort = DataFixureOutils::createCarPooling($dateDepartBxNiort, null, $tr_Bx_Niort, null, 20, [$this->q1, $this->q2, $this->q3], null);
  	
  	$covParisMarseille1 = DataFixureOutils::createCarPooling($dateDepartParisMarseille1, null, $tr_Paris_Marseille, $offreParisMarseille1, 17, null);
  	$covParisMarseille2 = DataFixureOutils::createCarPooling($dateDepartParisMarseille2, null, $tr_Paris_Marseille, $offreParisMarseille2, 20, null);
  	$covParisMarseille3 = DataFixureOutils::createCarPooling($dateDepartParisMarseille3, null, $tr_Paris_Marseille, null, 15, null);
  	
  	$covNantesTlse = DataFixureOutils::createCarPooling($dateDepartNantesTlse, null, $tr_Nantes_Tlse, null, 15, null);
  	$covBxLyon = DataFixureOutils::createCarPooling($dateDepartBxLyon, null, $tr_Bx_Lyon, null, 15, null);
  	
  	$this->persist([$covBxTlse, $covBxNiort, $covBxLyon, $covNantesTlse, $covParisMarseille1, $covParisMarseille2, $covParisMarseille3]);
  }
  
  /* 
   * (non-PHPdoc)
   * @see \Doctrine\Common\DataFixtures\OrderedFixtureInterface::getOrder()
   */
  public function getOrder() {
  	return 4;
  }
  
  private function loadQuestions()
  {
  	$listeQuestions = $this->em->getRepository(ConstClasses::CLASS_QUESTION)->findAll();
  	 
  	$this->q1 = DataFixureOutils::findQuestion('Pouvez vous me prendre à la sortie 6?', $listeQuestions);
  	$this->q2 = DataFixureOutils::findQuestion("J'ai deux petites sacs. Ca passe?", $listeQuestions);
  	$this->q3 = DataFixureOutils::findQuestion("Tu passes par Agen ?", $listeQuestions);
  }
  
//   private function loadEvents()
//   {
//   	$listeEvents = $this->em->getRepository(ConstClasses::CLASS_EVENT)->findAll();
  
//   	$this->event1 = TestOutils::findEvent('Evenement avorte', $listeEvents);
//   	$this->event2 = TestOutils::findEvent('Soiree Pizza fini dans 2h', $listeEvents);
//   }
  
  private function createCarPooling($dateDepart, $driver, $carpoolers, $trajet, $event, $price, $questions, $timer)
  {
  	$cov = DataFixureOutils::createCarPooling($dateDepart, $driver, $carpoolers, $trajet, $event);
  	$cov->setEvent($event);
  	$cov->setPrice($price);
  	$cov->setTimer($timer);
  	
  	if($questions !== null) {
	  	foreach ($questions as $question) {
	  		$cov->addQuestion($question);
	  	}
  	}
  	
  	return $cov;
  }
  
}
?>