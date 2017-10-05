<?php
namespace Tests\AppBundle\Repository;

use AppBundle\Constants\ConstClasses;

/**
 * CompteRepository Test class
 * @author Messi
 *
 */
class CompteRepositoryTest extends AbstractRepositoryTest
{
	
    public function testFindAll()
    {
        $result = static::$em->getRepository(ConstClasses::CLASS_COMPTE)->findAll();
        
        //
        
        $this->assertNotNull($result);
        $this->assertCount(3, $result);
    }
    
    public function testFindByUserId()
    {
    	$result = static::$em->getRepository(ConstClasses::CLASS_COMPTE)->findByUserId(1);
    
    	//
    
    	$this->assertNotNull($result);
    	$this->assertEquals(1, $result->getId());
    	$this->assertNotNull($result->getOwner());
    	$this->assertEquals(1, $result->getOwner()->getId());
    }
    
}
?>