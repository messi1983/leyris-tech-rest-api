<?php
namespace Tests\AppBundle\Service;

use AppBundle\Entity\CarPooling;
use AppBundle\Services\CarpoolingService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Pagination\Paginator;
use AppBundle\Entity\Trajet;
use AppBundle\Tests\TestOutils;
use AppBundle\Entity\CarpoolingRepository;

/**
 * CarpoolingService Test class
 * @author Messi
 *
 */
class CarpoolingServiceTest extends \PHPUnit_Framework_TestCase
{
	private $carPoolingService, $carpoolingRepository, $entityManager, $paginator;

	
	/**
	 * {@inheritDoc}
	 */
	protected function setUp()
	{
		$this->paginator = $this->getMockBuilder(Paginator::class)
							    ->disableOriginalConstructor()
				                ->getMock();
		
		$this->carpoolingRepository = $this->getMockBuilder(CarpoolingRepository::class)
							               ->disableOriginalConstructor()
		                                   ->getMock();
		
		$this->entityManager = $this->getMockBuilder(EntityManager::class)
    	                            ->disableOriginalConstructor()
    	                            ->getMock();
		
		$this->carpoolingService = new CarPoolingService($this->entityManager);
	}
	
    public function testFindAll()
    {
    	$this->carpoolingRepository->expects($this->once())
    	                           ->method('findAll')
    	                           ->will($this->returnValue([new CarPooling(), new CarPooling()]));
    	
    	$this->entityManager->expects($this->once())
    	                    ->method('getRepository')
    	                    ->will($this->returnValue($this->carpoolingRepository));
    	
    	//
    	//
    	
    	$result = $this->carpoolingService->findAll();
    	
        //
        //
        $this->assertNotNull($result);
        $this->assertCount(2, $result);
    }
    
    public function testFindById()
    {
    	$carpooling = new CarPooling();
    	$carpooling->setComment('commentaire');
    	
    	$this->carpoolingRepository->expects($this->once())
						    	   ->method('findOneBy')
						    	   ->will($this->returnValue($carpooling));
    	 
    	$this->entityManager->expects($this->once())
					    	->method('getRepository')
					    	->will($this->returnValue($this->carpoolingRepository));
    	 
    	//
    	//
    	 
    	$result = $this->carpoolingService->findById(1);
    	 
    	//
    	//
    	$this->assertNotNull($result);
    	$this->assertEquals('commentaire', $result->getComment());
    }
    
    public function testFindByDate()
    {
    	$this->carpoolingRepository->expects($this->once())
    	->method('findByRouteAndDatetimesInterval')
    	->will($this->returnValue($this->paginator));
    
    	$this->entityManager->expects($this->once())
    	->method('getRepository')
    	->will($this->returnValue($this->carpoolingRepository));
    
    	//
    	//
    	$trajet = new Trajet('Paris', 'Marseille');
    	$dateMin = new \DateTime('2017-07-02 10:00:00', new \DateTimeZone('Europe/Paris'));
    	$dateMax = new \DateTime('2017-07-02 23:00:00', new \DateTimeZone('Europe/Paris'));
    	$result = $this->carpoolingService->findByRouteAndDatetimesInterval($trajet, [$dateMin, $dateMax], 1);
    
    	//
    	//
    	$this->assertNotNull($result);
    	$this->assertEquals($this->paginator, $result);
    }
    
    public function testGetStats()
    {
    	$trajet = new Trajet('paris', 'Marseille');
    	$datetime = $h10 = new \DateTime('2017-07-02 10:00:00', new \DateTimeZone('Europe/Paris'));
    	$datetime = $h1030 = new \DateTime('2017-07-02 10:30:00', new \DateTimeZone('Europe/Paris'));
    	$datetime = $h1045 = new \DateTime('2017-07-02 10:45:00', new \DateTimeZone('Europe/Paris'));
    	 
    	$carpooling1 = new CarPooling();
    	$carpooling1->setDateDepart($h10);
    	$carpooling1->setNbPlacesRestantes(4);
    	$carpooling1->setPrice(17);
    	 
    	$carpooling2 = new CarPooling();
    	$carpooling2->setDateDepart($h10);
    	$carpooling2->setNbPlacesRestantes(4);
    	$carpooling2->setPrice(14);
    	 
    	$carpooling3 = new CarPooling();
    	$carpooling3->setDateDepart($h1030);
    	$carpooling3->setNbPlacesRestantes(4);
    	$carpooling3->setPrice(15);
    	 
    	$carpooling4 = new CarPooling();
    	$carpooling4->setDateDepart($h1045);
    	$carpooling4->setNbPlacesRestantes(4);
    	$carpooling4->setPrice(13);
    	
    	$this->carpoolingRepository->expects($this->once())
    	->method('findFromDatetime')
    	->will($this->returnValue([$carpooling1, $carpooling2, $carpooling3, $carpooling4]));
    	 
    	$this->entityManager->expects($this->once())
    	->method('getRepository')
    	->will($this->returnValue($this->carpoolingRepository));
    	
    	//
    	 
    	$stats = $this->carpoolingService->getStats($trajet, $datetime);
    	 
    	//
    	$this->assertNotNull($stats);
    	$this->assertCount(96, $stats);
    	$this->assertTrue(array_key_exists("00:00", $stats));
    	$this->assertTrue(array_key_exists("00:15", $stats));
    	$this->assertTrue(array_key_exists("00:30", $stats));
    	$this->assertTrue(array_key_exists("00:45", $stats));
    	 
    	$this->assertTrue(array_key_exists("10:00", $stats));
    	$this->assertTrue(array_key_exists("10:15", $stats));
    	$this->assertTrue(array_key_exists("10:30", $stats));
    	$this->assertTrue(array_key_exists("10:45", $stats));
    	 
    	$this->assertTrue(array_key_exists("20:00", $stats));
    	$this->assertTrue(array_key_exists("20:15", $stats));
    	$this->assertTrue(array_key_exists("20:30", $stats));
    	$this->assertTrue(array_key_exists("20:45", $stats));
    	 
    	$this->assertTrue(array_key_exists("23:00", $stats));
    	$this->assertTrue(array_key_exists("23:15", $stats));
    	$this->assertTrue(array_key_exists("23:30", $stats));
    	$this->assertTrue(array_key_exists("23:45", $stats));
    	 
    	$this->assertFalse(array_key_exists("24:00", $stats));
    	 
    	$tabNbCovNonComplets = $stats["10:00"];
    	 
    	$this->assertTrue(array_key_exists("nbCovNonComplets", $tabNbCovNonComplets));
    	$this->assertTrue(array_key_exists("prixMoyen", $tabNbCovNonComplets));
    	$this->assertEquals(2, $tabNbCovNonComplets["nbCovNonComplets"]);
    	$this->assertEquals(15.5, $tabNbCovNonComplets["prixMoyen"]);
    	$this->assertEquals(8, $tabNbCovNonComplets["nbPlacesDisponibles"]);
    	 
    	$tabNbCovNonComplets = $stats["00:15"];
    
    	$this->assertTrue(array_key_exists("nbCovNonComplets", $tabNbCovNonComplets));
    	$this->assertTrue(array_key_exists("prixMoyen", $tabNbCovNonComplets));
    	$this->assertEquals(0, $tabNbCovNonComplets["nbCovNonComplets"]);
    	$this->assertEquals(0, $tabNbCovNonComplets["prixMoyen"]);
    	$this->assertEquals(0, $tabNbCovNonComplets["nbPlacesDisponibles"]);
    }
    
}
?>