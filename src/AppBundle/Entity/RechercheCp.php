<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RechercheCp
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\RechercheCpRepository")
 */
class RechercheCp extends AbstractPulishedEntity
{
    /**
     * @ORM\Embedded(class = "AppBundle\Entity\Trajet")
     */
    private $trajet;
    
    /**
     * @ORM\Embedded(class = "AppBundle\Entity\Periode")
     */
    private $periode;
    
    /**
     * Constructor
     */
    public function __construct($trajet, $periode)
    {
    	parent::__construct();
    	$this->periode = $periode;
    	$this->trajet = $trajet;
    }
    
    /**
     * Set trajet
     *
     * @param \AppBundle\Entity\Trajet $trajet
     *
     * @return RechercheCp
     */
    public function setTrajet(\AppBundle\Entity\Trajet $trajet = null)
    {
        $this->trajet = $trajet;

        return $this;
    }

    /**
     * Get trajet
     *
     * @return \AppBundle\Entity\Trajet
     */
    public function getTrajet()
    {
        return $this->trajet;
    }

    /**
     * Set periode
     *
     * @param \AppBundle\Entity\Periode $periode
     *
     * @return RechercheCp
     */
    public function setPeriode(\AppBundle\Entity\Periode $periode = null)
    {
        $this->periode = $periode;

        return $this;
    }

    /**
     * Get periode
     *
     * @return \AppBundle\Entity\Periode
     */
    public function getPeriode()
    {
        return $this->periode;
    }
    
}
