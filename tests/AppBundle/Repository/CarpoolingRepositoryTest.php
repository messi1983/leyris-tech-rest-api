<?php
namespace Tests\AppBundle\Repository;

use AppBundle\Constants\ConstClasses;
use AppBundle\Entity\Trajet;

/**
 * CarpoolingRepository Test class
 * @author Messi
 *
 */
class CarpoolingRepositoryTest extends AbstractRepositoryTest
{
	public function testCountCpForEachDepartureDate()
	{
		$dateTimeMin = new \DateTime('2017-07-01 00:00:00', new \DateTimeZone('Europe/Paris'));
		$dateTimeMax = new \DateTime('2017-07-03 00:00:00', new \DateTimeZone('Europe/Paris'));
		 
		$trajet = new Trajet('Paris', 'Marseille');
		 
		//
		//
		 
		$tags = static::$em->getRepository(ConstClasses::CLASS_CAR_POOLING)->countCpForEachDepartureDate($trajet, [$dateTimeMin, $dateTimeMax]);
		 
		//
		//
		
		$this->assertNotNull($tags);
		$this->assertCount(1, $tags);
		
		$tag = $tags[0];
		
		$this->assertEquals(3, $tag['nbDepart']);
		$this->assertEquals('2017-07-02', $tag['date']);
	}
	
    public function testFindById()
    {
    	$result = static::$em->getRepository(ConstClasses::CLASS_CAR_POOLING)->findOneBy(array('id' => 1));
    
    	//
    
    	$this->assertNotNull($result);
    	$this->assertEquals(1, $result->getId());
    	$this->assertNotNull($result->getComment());
    	$this->assertEquals('messi comment', $result->getComment());
    	$this->assertNotNull($result->getTrajet());
    	$this->assertEquals('Bordeaux', $result->getTrajet()->getVilleDepart());
    	$this->assertEquals('Toulouse', $result->getTrajet()->getVilleArrivee());
    }
    
    public function testFindByRouteAndDatetimesInterval()
    {
    	$dateTimeMin = new \DateTime('2017-07-02 00:00:00', new \DateTimeZone('Europe/Paris'));
    	$dateTimeMax = new \DateTime('2017-07-02 23:29:59', new \DateTimeZone('Europe/Paris'));
    	
    	$trajet = new Trajet('Paris', 'Marseille');
    	
    	//
    	//
    	
    	$paginator = static::$em->getRepository(ConstClasses::CLASS_CAR_POOLING)->findByRouteAndDatetimesInterval($trajet, [$dateTimeMin, $dateTimeMax], 1);
    	$listCarpoolings = $paginator->getIterator()->getArrayCopy();
    	
    	//
    	//
    
    	$this->assertNotNull($paginator);
    	$this->assertCount(3, $paginator);
    	$this->assertCount(2, $listCarpoolings);
    	$this->assertEquals(2, $listCarpoolings[0]->getId());
    	$this->assertEquals(3, $listCarpoolings[1]->getId());
    }
    
}
?>