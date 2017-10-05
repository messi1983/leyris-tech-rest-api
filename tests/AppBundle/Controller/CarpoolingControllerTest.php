<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\DTO\CarPoolingDto;
use AppBundle\DTO\TrajetDto;
use AppBundle\DTO\UserDto;

class CarpoolingControllerTest extends WebTestCase
{
	public function testSearchOnDatePeriodAction()
	{
		$client = static::createClient();
	
		$client->request('GET', '/api/carpooling/search/date/periode?p=1&vArr=Marseille&vDep=Paris&dtMin=2017-07-01&dtMax=2017-07-03&date=2017-07-02');
	
		$response = $client->getResponse();
		$data = json_decode($response->getContent(), true);
	
		$this->assertTrue($response->headers->contains('Content-Type', 'application/json'));
		$this->assertEquals(200, $response->getStatusCode());
		$this->assertJson($response->getContent());
		$this->assertNotNull($data['datesInterval']);
		$this->assertEquals('2017-07-02', $data['mainDate']);
	}
	
	public function testSearchOnDatetimePeriodAction()
	{
		$client = static::createClient();
	
		$client->request('GET', '/api/carpooling/search/datetime/periode?p=1&vArr=Marseille&vDep=Paris&dtMin=2017-07-02 00:00:00&dtMax=2017-07-02 23:29:59');
		
		$response = $client->getResponse();
		$data = json_decode($response->getContent(), true);
	
		$this->assertTrue($response->headers->contains('Content-Type', 'application/json'));
		$this->assertEquals(200, $response->getStatusCode());
		$this->assertJson($response->getContent());
		$this->assertEquals(2, $data["nbPages"]);
	}
	
    public function testFindAction()
    {
        $client = static::createClient();

        $client->request('GET', '/api/carpooling/1');
        
        $response = $client->getResponse();
        $data = json_decode($response->getContent(), true);

        $this->assertTrue($response->headers->contains('Content-Type', 'application/json'));
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($response->getContent());
        $this->assertEquals(1, $data["id"]);
    }
    
    public function testCreateAction()
    {
    	$client = static::createClient();
    	
    	$trajetDto = new TrajetDto();
    	$trajetDto->setVilleDepart('Paris');
    	$trajetDto->setVilleArrivee('Lyon');
    	$trajetDto->setVilleDepart('Place Tourny');
    	$trajetDto->setVilleArrivee('Google');
    	
    	$userDto = new UserDto();
    	$userDto->setCompteId(1);
    	$userDto->setFirstname('Messi');
    	 
    	$carpoolingDto = new CarPoolingDto();
    	$carpoolingDto->setDateDepart(new \DateTime());
    	$carpoolingDto->setDateRetour(new \DateTime());
    	$carpoolingDto->setTrajet($trajetDto);
    	$carpoolingDto->setDriver($userDto);
    	$carpoolingDto->setEtat('VALIDE');
    	$carpoolingDto->setAllerRetour(false);
    	$carpoolingDto->setAcceptationAuto(false);
    	$carpoolingDto->setComment('messi comment');
    	$carpoolingDto->setPrice(30);
    	$carpoolingDto->setNbPlacesRestantes(5);
    	$carpoolingDto->setControlKey('new_Entity');
    
    	$params = array(
    			'dto' => $carpoolingDto
    	);
    
    	$client->request('POST', '/api/carpooling/create', $params, array(),array('CONTENT_TYPE' => 'application/json'));
    	 
    	$response = $client->getResponse();
    	$data = json_decode($response->getContent(), true);
    
    	$this->assertTrue($response->headers->contains('Content-Type', 'application/json'));
    	$this->assertEquals(200, $response->getStatusCode());
    	$this->assertJson($response->getContent());
    	$this->assertNotNull($data["id"]);
    	$this->assertEquals(30, $data["price"]);
    	$this->assertEquals(5, $data["nbPlacesRestantes"]);
    }
    
    public function testUpdateAction()
    {
    	$client = static::createClient();
    	
    	$carpoolingDto = new CarPoolingDto();
    	$carpoolingDto->setPrice(30);
    	$carpoolingDto->setNbPlacesRestantes(5);
    	$carpoolingDto->setControlKey('cp1end');
    	$carpoolingDto->setDateDepart(new \DateTime());
    	 
    	$params = array(
    			'dto' => $carpoolingDto
    	);
    
    	$client->request('PATCH', '/api/carpooling/update/1', $params, array(),array('CONTENT_TYPE' => 'application/json'));
    	
    	$response = $client->getResponse();
    	$data = json_decode($response->getContent(), true);
    
    	$this->assertTrue($response->headers->contains('Content-Type', 'application/json'));
    	$this->assertEquals(200, $response->getStatusCode());
    	$this->assertJson($response->getContent());
    	$this->assertEquals(1, $data["id"]);
    	$this->assertEquals(30, $data["price"]);
    	$this->assertEquals(5, $data["nbPlacesRestantes"]);
    }
    
    public function testCancelAction()
    {
    	$client = static::createClient();
    	
    	$carpoolingDto = new CarPoolingDto();
    	$carpoolingDto->setControlKey('cp1end');
    	
    	$params = array(
    			'dto' => $carpoolingDto
    	);
    	 
    	$client->request('PUT', '/api/carpooling/cancel/1', $params, array(),array('CONTENT_TYPE' => 'application/json'));
    	 
    	$response = $client->getResponse();
    	$data = json_decode($response->getContent(), true);
    
    	$this->assertTrue($response->headers->contains('Content-Type', 'application/json'));
    	$this->assertEquals(200, $response->getStatusCode());
    	$this->assertJson($response->getContent());
    	$this->assertEquals(1, $data["id"]);
    	$this->assertEquals('ANNULE', $data["etat"]);
    }
}
