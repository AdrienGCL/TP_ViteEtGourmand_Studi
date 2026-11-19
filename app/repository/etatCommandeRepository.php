<?php

namespace app\repository;

use app\db\Mysql;
use app\entity\EtatCommande;

class EtatCommandeRepository
{
    public function getAllEtatCommande(){
        try{
            // Appel bdd
            $mysql = Mysql::getInstance();
            $pdo = $mysql->getPDO();

            $requete = 'SELECT * FROM etat_commande';
            $query = $pdo->prepare($requete);

            $query->execute();

            $etatCommandeListe = [];
            while($etatCommandeAnswer = $query->fetch($pdo::FETCH_ASSOC)){
                $newEtatCommande = new EtatCommande;
                array_push($etatCommandeListe, $newEtatCommande->fromArray($etatCommandeAnswer));
            }
            
            return $etatCommandeListe;
        }
        catch(\Exception $e){
            // Gestion des erreurs
        }
    }

    public function getEtatCommandeById(int $id){
        try{
            // Appel bdd
            $mysql = Mysql::getInstance();
            $pdo = $mysql->getPDO();

            $requete = 'SELECT * FROM etat_commande WHERE etat_id = :id';
            $query = $pdo->prepare($requete);
            $query->bindValue(':id', $id, $pdo::PARAM_INT);

            $query->execute();

            $newEtatCommande = new EtatCommande;
            $selectedEtatCommande = $newEtatCommande->fromArray($query->fetch($pdo::FETCH_ASSOC));
            
            return $selectedEtatCommande;
        }
        catch(\Exception $e){
            // Gestion des erreurs
        }
    }
}