<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\DTO\UserDto;

class UserControllerTest extends WebTestCase
{
    public function testFindAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/user/1');
        $response = $client->getResponse();
        $data = json_decode($response->getContent(), true);

        $this->assertTrue($response->headers->contains('Content-Type', 'application/json'));
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($response->getContent());
        $this->assertEquals(1, $data["id"]);
    }
    
    public function testUpdateAction()
    {
    	$client = static::createClient();
    	 
    	$userDto = new UserDto();
    	$userDto->setLastname('Messi');
    	$userDto->setControlKey('cp1end');
    	
    	$params = array(
    			'dto' => $userDto
    	);
    
    	$client->request('PATCH', '/api/user/update/1', $params, array(),array('CONTENT_TYPE' => 'application/json'));
    	 
    	$response = $client->getResponse();
    	$data = json_decode($response->getContent(), true);
    
    	$this->assertTrue($response->headers->contains('Content-Type', 'application/json'));
    	$this->assertEquals(200, $response->getStatusCode());
    	$this->assertJson($response->getContent());
    	$this->assertEquals(1, $data["id"]);
    	$this->assertEquals('Messi', $data["lastname"]);
    }
}
