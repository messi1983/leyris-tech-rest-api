<?php
namespace Tests\AppBundle\Service;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Compte;
use AppBundle\Services\CompteService;
use AppBundle\Entity\User;

/**
 * CompteService Test class
 * @author Messi
 *
 */
class CompteServiceTest extends \PHPUnit_Framework_TestCase
{
	private $compteService, $compteRepository, $entityManager;

	
	/**
	 * {@inheritDoc}
	 */
	protected function setUp()
	{
		$this->compteRepository = $this->getMock(CompteRepository::class, ['findAll', 'findOneBy']);
		
		$this->entityManager = $this->getMockBuilder(EntityManager::class)
    	                            ->disableOriginalConstructor()
    	                            ->getMock();
		
		$this->compteService = new CompteService($this->entityManager);
	}
	
    public function testFindAll()
    {
    	$this->compteRepository->expects($this->once())
    	                       ->method('findAll')
    	                       ->will($this->returnValue([new Compte(), new Compte()]));
    	
    	$this->entityManager->expects($this->once())
    	                    ->method('getRepository')
    	                    ->will($this->returnValue($this->compteRepository));
    	
    	//
    	//
    	
    	$result = $this->compteService->findAll();
    	
        //
        //
        $this->assertNotNull($result);
        $this->assertCount(2, $result);
    }
    
    public function testFindById()
    {
    	$user = new User();
    	$user->setFirstname('messi');
    	
    	$compte = new Compte();
    	$compte->setOwner($user);
    	
    	$this->compteRepository->expects($this->once())
					    	   ->method('findOneBy')
					    	   ->will($this->returnValue($compte));
    	 
    	$this->entityManager->expects($this->once())
    	                     ->method('getRepository')
    	                     ->will($this->returnValue($this->compteRepository));
    	 
    	//
    	//
    	 
    	$result = $this->compteService->findById(1);
    	 
    	//
    	//
    	$this->assertNotNull($result);
    	$this->assertNotNull($result->getOwner());
    	$this->assertEquals('messi', $result->getOwner()->getFirstname());
    }
    
}
?>