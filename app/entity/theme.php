<?php

namespace app\entity;

class theme
{
    protected ?int $id = null;
    protected string $libelle = '';

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
        $this->setId((int)$data['theme_id']);
        $this->setLibelle((string)$data['libelle']);

        return $this;
    }
}