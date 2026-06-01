<?php

namespace app\repository;

use app\entity\plat;
use app\Db\mysql;

class PlatRepository
{
    public function getSinglePlat(int $id){
        try{
            // Appel bdd
            $mysql = mysql::getInstance();
            $pdo = $mysql->getPDO();

            $requete = 'SELECT * FROM plat WHERE plat_id = :id';
            $query = $pdo->prepare($requete);
            $query->bindValue(':id', $id, $pdo::PARAM_INT);

            $query->execute();

            $newPlat = new Plat;
            $selectedPlat = $newPlat->fromArray($query->fetch($pdo::FETCH_ASSOC));
            
            return $selectedPlat;
        }
        catch(\Exception $e){
            // Gestion des erreurs
        }
    }
}