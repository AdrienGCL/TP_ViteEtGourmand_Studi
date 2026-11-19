<?php

namespace app\entity;

class EtatCommande
{
    protected ?int $etat_id = null;
    protected string $libelle = '';

    /**
     * Get the value of etat_id
     */ 
    public function getId()
    {
        return $this->etat_id;
    }

    /**
     * Set the value of etat_id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->etat_id = $id;

        return $this;
    }

    /**
     * Get the value of libelle
     */ 
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set the value of libelle
     *
     * @return  self
     */ 
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function fromArray(array $data):self
    {
        $this->setId((int)$data['etat_id']);
        $this->setLibelle((string)$data['libelle']);

        return $this;
    }
}