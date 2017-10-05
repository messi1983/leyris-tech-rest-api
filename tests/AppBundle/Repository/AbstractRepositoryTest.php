<?php
namespace Tests\AppBundle\Repository;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

/**
 * AbstractRepositoryTest
 * @author Messi
 *
 */
abstract class AbstractRepositoryTest extends KernelTestCase
{
	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	protected static $em;
	
	protected static $encoder;
	
	/**
	 * {@inheritDoc}
	 */
	public static function setUpBeforeClass() {
	
		parent::setUpBeforeClass();
		self::bootKernel();
		
		static::$encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
		static::$em = static::$kernel->getContainer()->get('doctrine')->getManager();
	}
    
    /**
     * {@inheritDoc}
     */
    public static function tearDownAfterClass()
    {
    	parent::tearDownAfterClass();
    }
    
	protected static function createUser($userName, $email, $passw) {
    	$user = new User();
    	$user->setUsername($userName);
    	$user->setFirstname($userName);
    	$user->setLastname($userName);
    	$user->setEmail($email);
    	$user->setPassword(static::$encoder->encodePassword($passw, $user->getSalt()));
    	$user->setRoles(array('ROLE_AUTEUR'));
    	$user->setEnabled(true);
    	 
    	return $user;
    }
    
    protected static function persist($events) 
    {
    	foreach ($events as $event) {
    		static::$em->persist($event);
    	}
    	static::$em->flush();
    }
    
}
?>