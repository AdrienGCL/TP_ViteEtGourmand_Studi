<?php

namespace app\repository;

use app\db\Mysql;
use app\entity\Commande;

class CommandeRepository
{
    public function getAllCommande(){
        try{
            // Appel bdd
            $mysql = Mysql::getInstance();
            $pdo = $mysql->getPDO();

            $requete = 'SELECT * FROM commande';
            $query = $pdo->prepare($requete);

            $query->execute();

            $commandeListe = [];
            while($commandeAnswer = $query->fetch($pdo::FETCH_ASSOC)){
                $newCommande = new Commande;
                array_push($commandeListe, $newCommande->fromArray($commandeAnswer));
            }
            
            return $commandeListe;
        }
        catch(\Exception $e){
            // Gestion des erreurs
        }
    }

    public function getCommandeById(int $id){
        try{
            // Appel bdd
            $mysql = Mysql::getInstance();
            $pdo = $mysql->getPDO();

            $requete = 'SELECT * FROM commande WHERE commande_id = :id';
            $query = $pdo->prepare($requete);
            $query->bindValue(':id', $id, $pdo::PARAM_INT);

            $query->execute();

            $newCommande = new Commande;
            $selectedCommande = $newCommande->fromArray($query->fetch($pdo::FETCH_ASSOC));
            
            return $selectedCommande;
        }
        catch(\Exception $e){
            // Gestion des erreurs
        }
    }

    public function getCommandeByUserId(int $userId){
        try{
            // Appel bdd
            $mysql = Mysql::getInstance();
            $pdo = $mysql->getPDO();

            $requete = 'SELECT * FROM commande WHERE user = :userId';
            $query = $pdo->prepare($requete);
            $query->bindValue(':userId', $userId, $pdo::PARAM_INT);

            $query->execute();

            $commandeListe = [];
            while($commandeAnswer = $query->fetch($pdo::FETCH_ASSOC)){
                $newCommande = new Commande;
                array_push($commandeListe, $newCommande->fromArray($commandeAnswer));
            }
            
            return $commandeListe;
        }
        catch(\Exception $e){
            // Gestion des erreurs
        }
    }

    public function getCommandeByMenuId(int $menuId){
        try{
            // Appel bdd
            $mysql = Mysql::getInstance();
            $pdo = $mysql->getPDO();

            $requete = 'SELECT * FROM commande WHERE menu = :menuId';
            $query = $pdo->prepare($requete);
            $query->bindValue(':menuId', $menuId, $pdo::PARAM_INT);

            $query->execute();

            $commandeListe = [];
            while($commandeAnswer = $query->fetch($pdo::FETCH_ASSOC)){
                $newCommande = new Commande;
                array_push($commandeListe, $newCommande->fromArray($commandeAnswer));
            }
            
            return $commandeListe;
        }
        catch(\Exception $e){
            // Gestion des erreurs
        }
    }

    public function getCommandeByStatus(string $status){
        try{
            // Appel bdd
            $mysql = Mysql::getInstance();
            $pdo = $mysql->getPDO();

            $requete = 'SELECT * FROM commande WHERE etat = :status';
            $query = $pdo->prepare($requete);
            $query->bindValue(':status', $status, $pdo::PARAM_STR);

            $query->execute();

            $commandeListe = [];
            while($commandeAnswer = $query->fetch($pdo::FETCH_ASSOC)){
                $newCommande = new Commande;
                array_push($commandeListe, $newCommande->fromArray($commandeAnswer));
            }
            
            return $commandeListe;
        }
        catch(\Exception $e){
            // Gestion des erreurs
        }
    }

    public function isModifiable(int $commandeId): bool {
        try {
            // Appel bdd
            $mysql = Mysql::getInstance();
            $pdo = $mysql->getPDO();

            $requete = 'SELECT etat FROM commande WHERE commande_id = :commandeId';
            $query = $pdo->prepare($requete);
            $query->bindValue(':commandeId', $commandeId, $pdo::PARAM_INT);

            $query->execute();

            $etat = $query->fetchColumn();

            // Vérifie si l'état est 1 (en attente)
            return ($etat === 1);
        } catch (\Exception $e) {
            // Gestion des erreurs
            return false;
        }
    }

    public function createCommande(Commande $commande){
        try{
            // Appel bdd
            $mysql = Mysql::getInstance();
            $pdo = $mysql->getPDO();

            $requete = 'INSERT INTO commande (date_commande, date_livraison, heure_livraison, adresse_livraison, code_postale, ville, quantite, prix_ttc, prix_livraison, remise, menu, user, etat) VALUES (:dateCommande, :dateLivraison, :heureLivraison, :adresseLivraison, :codePostale, :ville, :quantite, :prixTtc, :prixLivraison, :remise, :menuId, :userId, :etat)';
            $query = $pdo->prepare($requete);
            $query->bindValue(':dateCommande', $commande->getDateCommande(), $pdo::PARAM_STR);
            $query->bindValue(':dateLivraison', $commande->getDateLivraison(), $pdo::PARAM_STR);
            $query->bindValue(':heureLivraison', $commande->getHeureLivraison(), $pdo::PARAM_STR);
            $query->bindValue(':adresseLivraison', $commande->getAdresseLivraison(), $pdo::PARAM_STR);
            $query->bindValue(':codePostale', $commande->getCodePostale(), $pdo::PARAM_INT);
            $query->bindValue(':ville', $commande->getVille(), $pdo::PARAM_STR);
            $query->bindValue(':quantite', $commande->getQuantite(), $pdo::PARAM_INT);
            $query->bindValue(':prixTtc', $commande->getPrix(), $pdo::PARAM_STR);
            $query->bindValue(':prixLivraison', $commande->getPrixLivraison(), $pdo::PARAM_STR);
            $query->bindValue(':remise', $commande->getRemise(), $pdo::PARAM_STR);
            $query->bindValue(':menuId', $commande->getMenu(), $pdo::PARAM_INT);
            $query->bindValue(':userId', $commande->getUser(), $pdo::PARAM_INT);
            $query->bindValue(':etat', $commande->getEtat(), $pdo::PARAM_INT);

            $query->execute();
        }
        catch(\Exception $e){
            // Gestion des erreurs
        }
    }
}