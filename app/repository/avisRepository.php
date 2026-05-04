<?php

namespace app\repository;

use app\entity\avis;
use app\db\mysql;

class AvisRepository
{
    public function findAllByStatut(int $statut, ?int $limit){

        try{
            // Appel bdd
            $mysql = mysql::getInstance();
            $pdo = $mysql->getPDO();

            $requete = 'SELECT * FROM avis WHERE statut = :statut ORDER BY avis_id DESC, note DESC';

            // Si limit != 0, ajoute une limite à la requête, sinon n'ajoute rien
            if($limit !== 0){
                $requete .= ' LIMIT :limit';
            }

            $query = $pdo->prepare($requete);
            $query->bindValue(':statut', $statut, $pdo::PARAM_INT);

            // Si limit != 0, bind les paramètres, sinon ne fais rien
            if($limit !== 0){
                $query->bindValue(':limit', $limit, $pdo::PARAM_INT);
            }
            
            $query->execute();
            $avisListe = [];
            // Créé un objet avis pour chaque résultat de la requête et l'ajoute au tableau
            while($avisAnswer = $query->fetch($pdo::FETCH_ASSOC)){
                $newAvis = new Avis;
                array_push($avisListe, $newAvis->fromArray($avisAnswer));
            }
            
            return $avisListe;
        }
        catch(\Exception $e){
            // Gestion des erreurs
        }
    }
}