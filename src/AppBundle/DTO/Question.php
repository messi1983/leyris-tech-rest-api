<?php

namespace AppBundle\DTO;

/**
 * Question
 */
class Question extends AbstractPublishedDto
{
    /**
     * @var string
     */
    private $libelle;
    
    /**
     * @var string
     */
    private $auteur;
    
    /**
     * @var string
     */
    private $reponse;

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return Question
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    
        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set auteur
     *
     * @param string $auteur
     * @return Question
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    
        return $this;
    }

    /**
     * Get auteur
     *
     * @return string 
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set reponse
     *
     * @param string $reponse
     * @return Question
     */
    public function setReponse($reponse)
    {
        $this->reponse = $reponse;
    
        return $this;
    }

    /**
     * Get reponse
     *
     * @return string
     */
    public function getReponse()
    {
        return $this->reponse;
    }
}