<?php

namespace app\repository;

use app\entity\entree;
use app\Db\mysql;

class EntreeRepository extends PlatRepository
{
    public function getSinglePlat(int $id){
        try{
            // Appel bdd
            $mysql = mysql::getInstance();
            $pdo = $mysql->getPDO();

            $requete = 'SELECT * FROM entree WHERE entree_id = :id';
            $query = $pdo->prepare($requete);
            $query->bindValue(':id', $id, $pdo::PARAM_INT);

            $query->execute();

            $newPlat = new Entree;
            $selectedPlat = $newPlat->fromArray($query->fetch($pdo::FETCH_ASSOC));
            
            return $selectedPlat;
        }
        catch(\Exception $e){
            // Gestion des erreurs
        }
    }
}