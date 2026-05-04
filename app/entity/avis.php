<?php

namespace app\entity;

use App\Tools\StringTools;
use App\Tools\stringTools as ToolsStringTools;

class Avis
{
    protected ?int $id = null;
    protected ?int $note = null;
    protected string $description = '';
    protected ?int $user = null;
    protected string $firstname = '';
    protected string $name = '';
    protected ?int $statut = null;

    

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
     * Get the value of note
     */ 
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set the value of note
     *
     * @return  self
     */ 
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    public function getUserFirstname()
    {
        return $this->firstname;
    }

    public function setUserFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function getUserName()
    {
        return $this->name;
    }

    public function setUserName($name)
    {
        $this->name = $name;
    }

    /**
     * Get the value of statut
     */ 
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set the value of statut
     *
     * @return  self
     */ 
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    // Remplissage des propriétés d'après un array
    public function fromArray(array $data): self
    {

        $this->setId((int)$data['avis_id']);
        $this->setNote((int)$data['note']);
        $this->setDescription($data['description']);
        $this->setUser($data['user']);
        // $avis->setUserFirstname($data['firstname']);
        // $avis->setUserName($data['name']);
        $this->setStatut($data['statut']);

        return $this;
    }
}