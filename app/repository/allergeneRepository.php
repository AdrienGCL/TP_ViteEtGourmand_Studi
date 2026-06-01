<?php

namespace app\repository;

use app\entity\allergene;
use app\db\mysql;
use app\tools\requestTools;

class allergeneRepository
{
    public function getPlatAllergenes(int $platId, string $plat){
        try{
            // Appel bdd
            $mysql = mysql::getInstance();
            $pdo = $mysql->getPDO();
            $requete = '';

            switch($plat){
                case 'entree':
                    $requete = 'SELECT allergene_id FROM entree_allergenes WHERE entree_id = :id';
                    break;
                case 'plat':
                    $requete = 'SELECT allergene_id FROM plat_allergenes WHERE plat_id = :id';
                    break;
                case 'dessert':
                    $requete = 'SELECT allergene_id FROM dessert_allergenes WHERE dessert_id = :id';
                    break;
                default :
                    throw new \Exception("Cette table n'existe pas : ".$plat);
                    break;
            }

            
            $query = $pdo->prepare($requete);
            $query->bindValue(':id', $platId, $pdo::PARAM_INT);

            $query->execute();
            $allergeneListe = [];
            while($allergeneIdAnswer = $query->fetch($pdo::FETCH_ASSOC)){
                foreach($allergeneIdAnswer as $value){
                    array_push($allergeneListe, $value);
                }
            }

            return $allergeneListe;
        }
        catch(\Exception $e){
            // Gestion des erreurs
            echo($e->getMessage());
            return $allergeneListe =[];
        }
    }

    public function getAllergenesById(array $idList)
    {
        try{
            // Appel bdd
            $mysql = mysql::getInstance();
            $pdo = $mysql->getPDO();

            $requeteTemplate = 'SELECT * FROM allergenes WHERE allergene_id IN (';
            $requete = RequestTools::buildFromIdList($idList, $requeteTemplate);

            $query = $pdo->prepare($requete);
            
            // bindvalue pour chaque id de la liste
            for($i = 0; $i < count($idList); $i++){
                $query->bindValue(':id'.$i, $idList[$i], $pdo::PARAM_INT);   
            }

            $query->execute();
            $allergenes = [];
            while($allergeneAnswer = $query->fetch($pdo::FETCH_ASSOC)){
                $newAllergene = new Allergene;
                array_push($allergenes, $newAllergene->fromArray($allergeneAnswer));
            }

            return $allergenes;
        }
        catch(\Exception $e){
            // Gestion des erreurs
        }
    }


}