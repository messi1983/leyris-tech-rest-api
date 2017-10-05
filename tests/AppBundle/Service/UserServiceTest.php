<?php
namespace Tests\AppBundle\Service;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\User;
use AppBundle\Services\UserService;

/**
 * UserService Test class
 * @author Messi
 *
 */
class UserServiceTest extends \PHPUnit_Framework_TestCase
{
	private $userService, $userRepository, $entityManager;

	
	/**
	 * {@inheritDoc}
	 */
	protected function setUp()
	{
		$this->userRepository = $this->getMock(UserRepository::class, ['findAll', 'findOneBy']);
		
		$this->entityManager = $this->getMockBuilder(EntityManager::class)
    	                            ->disableOriginalConstructor()
    	                            ->getMock();
		
		$this->userService = new UserService($this->entityManager);
	}
	
    public function testFindAll()
    {
    	$this->userRepository->expects($this->once())
    	                     ->method('findAll')
    	                     ->will($this->returnValue([new User(), new User()]));
    	
    	$this->entityManager->expects($this->once())
    	                    ->method('getRepository')
    	                    ->will($this->returnValue($this->userRepository));
    	
    	//
    	//
    	
    	$result = $this->userService->findAll();
    	
        //
        //
        $this->assertNotNull($result);
        $this->assertCount(2, $result);
    }
    
    public function testFindById()
    {
    	$user = new User();
    	$user->setFirstname('messi');
    	
    	$this->userRepository->expects($this->once())
					    	 ->method('findOneBy')
					    	 ->will($this->returnValue($user));
    	 
    	$this->entityManager->expects($this->once())
    	                    ->method('getRepository')
    	                    ->will($this->returnValue($this->userRepository));
    	 
    	//
    	//
    	 
    	$result = $this->userService->findById(1);
    	 
    	//
    	//
    	$this->assertNotNull($result);
    	$this->assertEquals('messi', $result->getFirstname());
    }
    
}
?>