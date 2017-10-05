<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\DTO\CarPoolingDto;
use AppBundle\Entity\ReservationCp;
use AppBundle\DTO\ReservationCpDto;
use AppBundle\DTO\UserDto;

class ReservationCpControllerTest extends WebTestCase
{
    public function testReservationAction()
    {
        $client = static::createClient();
        
        $userDto = new UserDto();
        $userDto->setCompteId(1);
        $userDto->setFirstname('Messi');
        
        $reservationDto = new ReservationCpDto();
        $reservationDto->setUser($userDto);
        $reservationDto->setCarpoolingId(1);
        $reservationDto->setNbPlaces(2);
        $reservationDto->setMultiGroupe('messi');
        $reservationDto->setControlKey('new_Entity');
        
        $params = array(
        		'dto' => $reservationDto
        );
        
        $client->request('POST', '/api/reservation/carpooling', $params, array(),array('CONTENT_TYPE' => 'application/json'));

        $response = $client->getResponse();
        $data = json_decode($response->getContent(), true);

        $this->assertTrue($response->headers->contains('Content-Type', 'application/json'));
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($response->getContent());
        $this->assertNotNull($data["id"]);
    }
    
    public function testCancelAction()
    {
    	$client = static::createClient();
    	
    	$reservationDto = new ReservationCpDto();
    	$reservationDto->setControlKey('cp1end');
    	
    	$params = array(
    			'dto' => $reservationDto
    	);
    	 
    	$client->request('PUT', '/api/reservation/carpooling/cancel/1', $params, array(),array('CONTENT_TYPE' => 'application/json'));
    	 
    	$response = $client->getResponse();
    	$data = json_decode($response->getContent(), true);
    
    	$this->assertTrue($response->headers->contains('Content-Type', 'application/json'));
    	$this->assertEquals(200, $response->getStatusCode());
    	$this->assertJson($response->getContent());
    	$this->assertEquals(1, $data["id"]);
    	$this->assertEquals('ANNULEE', $data["etat"]);
    }
    
    public function testRefuseAction()
    {
    	$client = static::createClient();
    	 
    	$reservationDto = new ReservationCpDto();
    	$reservationDto->setControlKey('cp1end');
    	 
    	$params = array(
    			'dto' => $reservationDto
    	);
    
    	$client->request('PUT', '/api/reservation/carpooling/refuse/1', $params, array(),array('CONTENT_TYPE' => 'application/json'));
    
    	$response = $client->getResponse();
    	$data = json_decode($response->getContent(), true);
    
    	$this->assertTrue($response->headers->contains('Content-Type', 'application/json'));
    	$this->assertEquals(200, $response->getStatusCode());
    	$this->assertJson($response->getContent());
    	$this->assertEquals(1, $data["id"]);
    	$this->assertEquals('REFUSEE', $data["etat"]);
    }
    
    public function testAcceptAction()
    {
    	$client = static::createClient();
    
    	$reservationDto = new ReservationCpDto();
    	$reservationDto->setControlKey('cp1end');
    
    	$params = array(
    			'dto' => $reservationDto
    	);
    
    	$client->request('PUT', '/api/reservation/carpooling/accept/1', $params, array(),array('CONTENT_TYPE' => 'application/json'));
    
    	$response = $client->getResponse();
    	$data = json_decode($response->getContent(), true);
    
    	$this->assertTrue($response->headers->contains('Content-Type', 'application/json'));
    	$this->assertEquals(200, $response->getStatusCode());
    	$this->assertJson($response->getContent());
    	$this->assertEquals(1, $data["id"]);
    	$this->assertEquals('ACCEPTEE', $data["etat"]);
    }
    
}
