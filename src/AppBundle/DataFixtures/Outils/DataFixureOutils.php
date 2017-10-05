<?php
namespace AppBundle\DataFixtures\Outils;

use AppBundle\Constants\Constants;
use AppBundle\Entity\Event;
use AppBundle\Entity\Periode;
use AppBundle\Entity\Stage;
use AppBundle\Entity\Soiree;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use AppBundle\Entity\Carpooling;
use AppBundle\Entity\User;
use AppBundle\Entity\Trajet;
use AppBundle\Entity\Accommodation;
use AppBundle\Entity\Adresse;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use AppBundle\Entity\Question;
use AppBundle\Entity\Compte;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Test utilitarian
 * @author Messi
 *
 */
class DataFixureOutils
{
	/**
	 * Constructor
	 */
	private function __construct()
	{
	}
	
	public static function findUser($firstname, $listeUsers) {
		if($listeUsers !== null) {
			foreach ($listeUsers as $user) {
				if($user->getFirstname() === $firstname) {
					return $user;
				}
			}
		}
		return null;
	}
	
	public static function findTrajet($villeDepart, $villeArrivee, $listeTrajets) {
		if($listeTrajets !== null) {
			foreach ($listeTrajets as $trajet) {
				if($trajet->getVilleDepart() === $villeDepart
						&& $trajet->getVilleArrivee() === $villeArrivee) {
							return $trajet;
				}
			}
		}
		return null;
	}
	
	public static function findQuestion($libelle, $listeQuestions) {
		if($listeQuestions !== null) {
			foreach ($listeQuestions as $question) {
				if($question->getLibelle() == $libelle) {
					return $question;
				}
			}
		}
		return null;
	}
	
	public static function findEvent($libelle, $listeEvents) {
		if($listeEvents !== null) {
			foreach ($listeEvents as $event) {
				if($event->getIdentification() == $libelle) {
					return $event;
				}
			}
		}
		return null;
	}
	
	public static function findCarpooling($villeDepart, $villeArrivee, $listeCarpoolings) {
		if($listeCarpoolings !== null) {
			foreach ($listeCarpoolings as $carpooling) {
				if($carpooling->getTrajet()->getVilleDepart() === $villeDepart
						&& $carpooling->getTrajet()->getVilleArrivee() === $villeArrivee) {
					return $carpooling;
				}
			}
		}
		return null;
	}
    
	/**
	 * Crée un utilisateur
	 * @param unknown $userName
	 * @param unknown $email
	 * @param unknown $passw
	 * @return \AppBundle\Entity\User
	 */
	public static function createUser($userName, $email, $passw) {
		$encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
		
    	$user = new User();
    	$user->setUsername($userName);
    	$user->setFirstname($userName);
    	$user->setLastname($userName);
    	$user->setEmail($email);
    	$user->setPassword($encoder->encodePassword($passw, $user->getSalt()));
    	$user->setRoles(array('ROLE_AUTEUR'));
    	$user->setEnabled(true);
    	 
    	return $user;
    }
    
    /**
     * Crée une adresse
     * @param unknown $num
     * @param unknown $rue
     * @param unknown $codePostal
     * @param unknown $ville
     * @return \Lmi\EventBundle\Entity\Adresse
     */
    public static function createAdresse($num, $rue, $codePostal, $ville)
    {
    	$adresse = new Adresse();
    	$adresse->setNumero($num);
    	$adresse->setRue($rue);
    	$adresse->setCodePostal($codePostal);
    	$adresse->setVille($ville);
    
    	return $adresse;
    }
    
    /**
     * Crée un evenement via une liste de covoiturages
     * @param unknown $identification
     * @param unknown $covoiturages
     * @return \Lmi\EventBundle\Entity\Event
     */
    public static function createEventFromCarPoolings($identification, $covoiturages)
    {
    	$event = new Event();
    	$event->setIdentification($identification);
    	$event->setPublication(true);
    
    	foreach ($covoiturages as $covoiturage) {
    		$event->addCarpooling($covoiturage);
    	}
    	return $event;
    }
    
    /**
     * Crée un evenement via une liste de soirées et une liste de stages
     * @param unknown $identification
     * @param unknown $soirees
     * @param unknown $stages
     * @return \Lmi\EventBundle\Entity\Event
     */
    public static function createEvent($identification, $soirees, $stages)
    {
    	$event = new Event();
    	$event->setIdentification($identification);
    	$event->setPublication(true);
    
    	foreach ($soirees as $soiree) {
    		$event->addSoiree($soiree);
    	}
    	foreach ($stages as $stage) {
    		$event->addStage($stage);
    	}
    	return $event;
    }
    
    /**
     * Crée un evenement via une liste d'hebergements
     * @param unknown $identification
     * @param unknown $hebergements
     * @return \Lmi\EventBundle\Entity\Event
     */
    public static function createEventFromAcc($identification, $hebergements)
    {
    	$event = new Event();
    	$event->setIdentification($identification);
    	$event->setPublication(true);
    
    	if($hebergements !== null) {
	    	foreach ($hebergements as $hebergement) {
	    		$event->addHebergement($hebergement);
	    	}
    	}
    	return $event;
    }
    
    /**
     * Crée un covoiturage
     * @param unknown $dateDepart
     * @param unknown $driver
     * @param unknown $carpoolers
     * @param unknown $trajet
     * @param unknown $event
     * @return \Lmi\EventBundle\Entity\CarPooling
     */
    public static function createCarPooling($dateDepart, $driverCompte, $trajet, $offre, $price, $questions)
    {
    	$cov = new Carpooling();
    	$cov->setPublication(true);
    	$cov->setDateDepart($dateDepart);
    	$cov->setDriver($driverCompte);
    	$cov->setOffreEmise($offre);
    	$cov->setPrice($price);
    
    	if($questions !== null) {
    		foreach ($questions as $question) {
    			$cov->addQuestion($question);
    		}
    	}
    	$cov->setNbPlacesRestantes(4);
    	$cov->setTrajet($trajet);
    	return $cov;
    }

    
    /**
     * Crée un hébergement
     * @param unknown $type
     * @param unknown $periode
     * @param unknown $adresse
     * @param unknown $host
     * @param unknown $tenants
     * @param unknown $event
     * @return \Lmi\EventBundle\Entity\Accommodation
     */
    public static function createAccommodation($type, $periode, $adresse, $host, $tenants, $event)
    {
    	$heb = new Accommodation();
    	$heb->setType($type);
    	$heb->setAdresse($adresse);
    	$heb->setPeriode($periode);
    	$heb->setHost($host);
    	$heb->setNbPlaces(4);
    	$heb->setPublication(true);
    	
    	if($event !== null) {
    		$heb->addEvent($event);
    	}
    
    	foreach ($tenants as $tenant) {
    		$heb->addTenant($tenant);
    	}
    	return $heb;
    }
    
    public static function createSoiree($ident, $periode, $descriptif, $ambiances, $adresse)
    {
    	$soiree = new Soiree();
    	$soiree->setPublication(true);
    	$soiree->setDates($periode);
    	$soiree->setIdentification($ident);
    	$soiree->setDesciptif($descriptif);
    	$soiree->setProgramme('Programe 2');
    	$soiree->setAmbiances($ambiances);
    	$soiree->setAdresse($adresse);
    
    	return $soiree;
    }
    
    public static function createStage($danse, $dates, $desciptif)
    {
    	$stage = new Stage();
    	$stage->setPublication(true);
    	$stage->setDanse($danse);
    	$stage->setDates($dates);
    	$stage->setDesciptif($desciptif);
    	return $stage;
    }
    
    public static function createQuestion($libelle, $auteur, $reponse) {
    	$question = new Question();
    	$question->setLibelle($libelle);
    	$question->setAuteur($auteur);
    	$question->setReponse($reponse);
    
    	return $question;
    }
    
    public static function createCompte($owner, $listeContacts) {
    	$compte = new Compte();
    	$compte->setOwner($owner);
    	
    	foreach ($listeContacts as $contact) {
    		$compte->addContact($contact);
    	}
    	return $compte;
    }
}
?>