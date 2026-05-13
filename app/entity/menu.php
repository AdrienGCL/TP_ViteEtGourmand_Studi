<?php

namespace app\entity;

class Menu
{
    protected ?int $id = null;
    protected string $titre = '';
    protected int $quantiteMin = 1;
    protected float $prix = 0;
    protected string $description = '';
    protected int $quantiteDispo = 0;
    protected string $conditions = '';
    protected ?int $regime = null;
    protected ?int $theme = null;
    protected ?int $entree = null;
    protected ?int $plat = null;
    protected ?int $dessert = null;

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
     * Get the value of titre
     */ 
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set the value of titre
     *
     * @return  self
     */ 
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get the value of quantiteMin
     */ 
    public function getQuantiteMin()
    {
        return $this->quantiteMin;
    }

    /**
     * Set the value of quantiteMin
     *
     * @return  self
     */ 
    public function setQuantiteMin($quantiteMin)
    {
        $this->quantiteMin = $quantiteMin;

        return $this;
    }

    /**
     * Get the value of prix
     */ 
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set the value of prix
     *
     * @return  self
     */ 
    public function setPrix($prix)
    {
        $this->prix = $prix;

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
     * Get the value of quantiteDispo
     */ 
    public function getQuantiteDispo()
    {
        return $this->quantiteDispo;
    }

    /**
     * Set the value of quantiteDispo
     *
     * @return  self
     */ 
    public function setQuantiteDispo($quantiteDispo)
    {
        $this->quantiteDispo = $quantiteDispo;

        return $this;
    }

    /**
     * Get the value of conditions
     */ 
    public function getConditions()
    {
        return $this->conditions;
    }

    /**
     * Set the value of conditions
     *
     * @return  self
     */ 
    public function setConditions($conditions)
    {
        $this->conditions = $conditions;

        return $this;
    }

    /**
     * Get the value of regime
     */ 
    public function getRegime()
    {
        return $this->regime;
    }

    /**
     * Set the value of regime
     *
     * @return  self
     */ 
    public function setRegime($regime)
    {
        $this->regime = $regime;

        return $this;
    }

    /**
     * Get the value of theme
     */ 
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set the value of theme
     *
     * @return  self
     */ 
    public function setTheme($theme)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get the value of entree
     */ 
    public function getEntree()
    {
        return $this->entree;
    }

    /**
     * Set the value of entree
     *
     * @return  self
     */ 
    public function setEntree($entree)
    {
        $this->entree = $entree;

        return $this;
    }

    /**
     * Get the value of plat
     */ 
    public function getPlat()
    {
        return $this->plat;
    }

    /**
     * Set the value of plat
     *
     * @return  self
     */ 
    public function setPlat($plat)
    {
        $this->plat = $plat;

        return $this;
    }

    /**
     * Get the value of dessert
     */ 
    public function getDessert()
    {
        return $this->dessert;
    }

    /**
     * Set the value of dessert
     *
     * @return  self
     */ 
    public function setDessert($dessert)
    {
        $this->dessert = $dessert;

        return $this;
    }


    // Remplissage des propriétés d'après un array
    public function fromArray(array $data): self
    {

        $this->setId((int)$data['menu_id']);
        $this->setTitre((string)$data['titre']);
        $this->setQuantiteMin((int)$data['quantite_min']);
        $this->setPrix((float)$data['prix']);
        $this->setDescription((string)$data['description']);
        $this->setQuantiteDispo((int)$data['quantite_dispo']);
        $this->setConditions((string)$data['conditions']);
        $this->setRegime((int)$data['regime']);
        $this->setTheme((int)$data['theme']);
        $this->setEntree((int)$data['entree']);
        $this->setPlat((int)$data['plat']);
        $this->setDessert((int)$data['dessert']);

        return $this;
    }
}