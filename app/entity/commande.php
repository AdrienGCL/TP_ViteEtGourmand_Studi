<?php

namespace app\entity;

class Commande
{
    protected ?int $id = null;
    protected string $dateCommande = '';
    protected string $dateLivraison = '';
    protected string $heureLivraison = '';
    protected string $adresseLivraison = '';
    protected ?int $codePostale = null;
    protected string $ville = '';
    protected int $quantite = 0;
    protected float $prix = 0;
    protected float $prixLivraison = 0;
    protected float $remise = 0;
    protected ?int $materiel = null;
    protected ?int $retourMateriel = null;
    protected ?int $menu = null;
    protected ?int $user = null;
    protected ?int $etat = null;

    

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
     * Get the value of dateCommande
     */ 
    public function getDateCommande()
    {
        return $this->dateCommande;
    }

    /**
     * Set the value of dateCommande
     *
     * @return  self
     */ 
    public function setDateCommande($dateCommande)
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    /**
     * Get the value of dateLivraison
     */ 
    public function getDateLivraison()
    {
        return $this->dateLivraison;
    }

    /**
     * Set the value of dateLivraison
     *
     * @return  self
     */ 
    public function setDateLivraison($dateLivraison)
    {
        $this->dateLivraison = $dateLivraison;

        return $this;
    }

    /**
     * Get the value of heureLivraison
     */ 
    public function getHeureLivraison()
    {
        return $this->heureLivraison;
    }

    /**
     * Set the value of heureLivraison
     *
     * @return  self
     */ 
    public function setHeureLivraison($heureLivraison)
    {
        $this->heureLivraison = $heureLivraison;

        return $this;
    }

    /**
     * Get the value of adresseLivraison
     */ 
    public function getAdresseLivraison()
    {
        return $this->adresseLivraison;
    }

    /**
     * Set the value of adresseLivraison
     *
     * @return  self
     */ 
    public function setAdresseLivraison($adresseLivraison)
    {
        $this->adresseLivraison = $adresseLivraison;

        return $this;
    }

    /**
     * Get the value of codePostale
     */ 
    public function getCodePostale()
    {
        return $this->codePostale;
    }

    /**
     * Set the value of codePostale
     *
     * @return  self
     */ 
    public function setCodePostale($codePostale)
    {
        $this->codePostale = $codePostale;

        return $this;
    }

    /**
     * Get the value of ville
     */ 
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set the value of ville
     *
     * @return  self
     */ 
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get the value of quantite
     */ 
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set the value of quantite
     *
     * @return  self
     */ 
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

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
     * Get the value of prixLivraison
     */ 
    public function getPrixLivraison()
    {
        return $this->prixLivraison;
    }

    /**
     * Set the value of prixLivraison
     *
     * @return  self
     */ 
    public function setPrixLivraison($prixLivraison)
    {
        $this->prixLivraison = $prixLivraison;

        return $this;
    }

    /**
     * Get the value of remise
     */ 
    public function getRemise()
    {
        return $this->remise;
    }

    /**
     * Set the value of remise
     *
     * @return  self
     */ 
    public function setRemise($remise)
    {
        $this->remise = $remise;

        return $this;
    }

    /**
     * Get the value of materiel
     */ 
    public function getMateriel()
    {
        return $this->materiel;
    }

    /**
     * Set the value of materiel
     *
     * @return  self
     */ 
    public function setMateriel($materiel)
    {
        $this->materiel = $materiel;

        return $this;
    }

    /**
     * Get the value of retourMateriel
     */ 
    public function getRetourMateriel()
    {
        return $this->retourMateriel;
    }

    /**
     * Set the value of retourMateriel
     *
     * @return  self
     */ 
    public function setRetourMateriel($retourMateriel)
    {
        $this->retourMateriel = $retourMateriel;

        return $this;
    }

    /**
     * Get the value of menu
     */ 
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Set the value of menu
     *
     * @return  self
     */ 
    public function setMenu($menu)
    {
        $this->menu = $menu;

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

    /**
     * Get the value of etat
     */ 
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set the value of etat
     *
     * @return  self
     */ 
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }


    // Remplissage des propriétés d'après un array
    public function fromArray(array $data): self
    {

        $this->setId((int)$data['commande_id']);
        $this->setDateCommande((string)$data['date_commande']);
        $this->setDateLivraison((string)$data['date_livraison']);
        $this->setHeureLivraison((string)$data['heure_livraison']);
        $this->setAdresseLivraison((string)$data['adresse_livraison']);
        $this->setCodePostale((string)$data['code_postale']);
        $this->setVille((string)$data['ville']);
        $this->setQuantite((int)$data['quantite']);
        $this->setPrix((float)$data['prix_ttc']);
        $this->setPrixLivraison((float)$data['prix_livraison']);
        $this->setRemise((float)$data['remise']);
        $this->setMateriel((int)$data['materiel']);
        $this->setRetourMateriel((int)$data['retour_materiel']);
        $this->setMenu((int)$data['menu']);
        $this->setUser((int)$data['user']);
        $this->setEtat((int)$data['etat']);

        return $this;
    }
}