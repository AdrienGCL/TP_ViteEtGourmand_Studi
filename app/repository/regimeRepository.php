<?php

namespace app\repository;

use app\entity\regime;
use app\Db\mysql;

class RegimeRepository
{
    public function getAllRegime(){
        try{
            // Appel bdd
            $mysql = mysql::getInstance();
            $pdo = $mysql->getPDO();

            $requete = 'SELECT * FROM regime';
            $query = $pdo->prepare($requete);

            $query->execute();

            $regimeListe = [];
            while($regimeAnswer = $query->fetch($pdo::FETCH_ASSOC)){
                $newRegime = new Regime;
                array_push($regimeListe, $newRegime->fromArray($regimeAnswer));
            }
            
            return $regimeListe;
        }
        catch(\Exception $e){
            // Gestion des erreurs
        }
    }
}