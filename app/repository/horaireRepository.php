<?php

namespace app\repository;

use app\entity\horaire;
use App\Db\Mysql;

class HoraireRepository
{
    public function getAllHoraires(){
        try{
            // Appel bdd
            $mysql = mysql::getInstance();
            $pdo = $mysql->getPDO();

            $requete = 'SELECT * FROM horaire';

            $query = $pdo->prepare($requete);
            $query->execute();

            $horaireListe = [];
            // Créé un objet horaire pour chaque résultat de la requête et l'ajoute au tableau
            while($horaireAnswer = $query->fetch($pdo::FETCH_ASSOC)){
                $newHoraire = new Horaire;
                array_push($horaireListe, $newHoraire->fromArray($horaireAnswer));
            }
            
            return $horaireListe;
        }
        catch(\Exception $e){
            // Gestion des erreurs
        }
    }
}