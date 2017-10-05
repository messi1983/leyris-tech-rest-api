<?php
namespace Tests\AppBundle\Service;

use AppBundle\Entity\CarPooling;
use AppBundle\Services\CarpoolingService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Pagination\Paginator;
use AppBundle\Entity\Trajet;
use AppBundle\Tests\TestOutils;
use AppBundle\Entity\ReservationCp;

/**
 * Carpooling Test class
 * @author Messi
 *
 */
class CarpoolingTest extends \PHPUnit_Framework_TestCase
{
    public function testIsCompleteKO()
    {
		$reservation1 = new ReservationCp('EN_COURS');
		$reservation2 = new ReservationCp('ACCEPTEE');
		$reservation3 = new ReservationCp('REFUSEE');
    	
    	$carpooling = new CarPooling();
    	$carpooling->setNbPlacesRestantes(3);
    	$carpooling->addReservation($reservation1);
    	$carpooling->addReservation($reservation2);
    	$carpooling->addReservation($reservation3);
    	
    	//
        //
        $this->assertEquals(1, $carpooling->getNbPlacesRestantes());
        $this->assertFalse($carpooling->isComplete());
    }
    
    public function testIsCompleteOK()
    {
    	$reservation1 = $this->createReservationCp('EN_COURS');
    	$reservation2 = $this->createReservationCp('ACCEPTEE');
    	$reservation3 = $this->createReservationCp('ACCEPTEE');
    	 
    	$carpooling = new CarPooling();
    	$carpooling->setNbPlacesRestantes(3);
    	$carpooling->addReservation($reservation1);
    	$carpooling->addReservation($reservation2);
    	$carpooling->addReservation($reservation3);
    	 
    	//
    	//
    	$this->assertTrue($carpooling->isComplete());
    }
    
    public function testGetHeureDepart()
    {
    	$datetime = $h10 = new \DateTime('2017-07-02 10:00:00', new \DateTimeZone('Europe/Paris'));
    	
    	$carpooling = new CarPooling();
    	$carpooling->setDateDepart($h10);
    	 
    	//
    	//
    	$this->assertEquals("10:00", $carpooling->getHeureDepart());
    }
    
    private function createReservationCp($etat)
    {
    	$reservation = new ReservationCp();
    	$reservation->setEtat($etat);
    	
    	return $reservation;
    }
    
}
?>