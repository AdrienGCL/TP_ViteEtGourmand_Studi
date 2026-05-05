<?php

namespace app\entity;

class horaire{
    protected ?int $id = null;
    protected string $jour = '';
    protected string $ouverture = '';
    protected string $fermeture = '';

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of jour
     */ 
    public function getJour()
    {
        return $this->jour;
    }

    /**
     * Set the value of jour
     *
     * @return  self
     */ 
    public function setJour($jour)
    {
        $this->jour = $jour;

        return $this;
    }

    /**
     * Get the value of ouverture
     */ 
    public function getOuverture()
    {
        return $this->ouverture;
    }

    /**
     * Set the value of ouverture
     *
     * @return  self
     */ 
    public function setOuverture($ouverture)
    {
        $this->ouverture = $ouverture;

        return $this;
    }

    /**
     * Get the value of fermeture
     */ 
    public function getFermeture()
    {
        return $this->fermeture;
    }

    /**
     * Set the value of fermeture
     *
     * @return  self
     */ 
    public function setFermeture($fermeture)
    {
        $this->fermeture = $fermeture;

        return $this;
    }

    // Remplissage des propriétés d'après un array
    public function fromArray(array $data): self
    {

        $this->setId((int)$data['horaire_id']);
        $this->setJour((string)$data['jour']);
        $this->setOuverture((string)$data['ouverture']);
        $this->setFermeture((string)$data['fermeture']);

        return $this;
    }
}