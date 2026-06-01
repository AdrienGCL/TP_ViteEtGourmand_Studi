<?php

namespace app\repository;

use app\entity\dessert;
use app\Db\mysql;

class DessertRepository extends PlatRepository
{
    public function getSinglePlat(int $id){
        try{
            // Appel bdd
            $mysql = mysql::getInstance();
            $pdo = $mysql->getPDO();

            $requete = 'SELECT * FROM dessert WHERE dessert_id = :id';
            $query = $pdo->prepare($requete);
            $query->bindValue(':id', $id, $pdo::PARAM_INT);

            $query->execute();

            $newPlat = new Dessert;
            $selectedPlat = $newPlat->fromArray($query->fetch($pdo::FETCH_ASSOC));
            
            return $selectedPlat;
        }
        catch(\Exception $e){
            // Gestion des erreurs
        }
    }
}