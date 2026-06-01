<?php

namespace app\repository;

use app\entity\regime;
use app\Db\mysql;
use app\entity\Regime as EntityRegime;

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

    public function getSingleRegime(int $id){
        try{
            // Appel bdd
            $mysql = mysql::getInstance();
            $pdo = $mysql->getPDO();

            $requete = 'SELECT * FROM regime WHERE regime_id = :id';
            $query = $pdo->prepare($requete);
            $query->bindValue(':id', $id, $pdo::PARAM_INT);

            $query->execute();

            $newRegime = new Regime;
            $selectedRegime = $newRegime->fromArray($query->fetch($pdo::FETCH_ASSOC));
            
            return $selectedRegime;
        }
        catch(\Exception $e){
            // Gestion des erreurs
        }
    }
}