<?php

namespace app\repository;

use app\entity\User;
use app\Db\Mysql;
use app\tools\requestTools;

Class UserRepository
{
    // Get users selon une liste d'id
    public function getUserNameById(array $idList = [])
    {
        try{
            // Appel bdd
            $mysql = mysql::getInstance();
            $pdo = $mysql->getPDO();

            $requeteTemplate = 'SELECT user_id, prenom, nom FROM user WHERE user_id IN (';
            $requete = RequestTools::buildFromIdList($idList, $requeteTemplate);

            $query = $pdo->prepare($requete);
            
            // bindvalue pour chaque id de la liste
            for($i = 0; $i < count($idList); $i++){
                $query->bindValue(':id'.$i, $idList[$i], $pdo::PARAM_INT);   
            }
            
            $query->execute();
            $userListe = [];
            while($userAnswer = $query->fetch($pdo::FETCH_ASSOC)){
                array_push($userListe, $userAnswer);
            }
            
            return $userListe;
        }
        catch(\Exception $e){
            // Gestion des erreurs
        }
    }
}