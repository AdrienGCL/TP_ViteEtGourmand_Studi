<?php

namespace app\tools;

class requestTools
{
    public static function buildFromIdList(array $idList, string $requete)
    {
        // Ajout d'un paramètre à la requête pour chaque id de la liste
        for($i = 0; $i < count($idList); $i++){
            if($i == count($idList)-1){
                $requete .= ':id'.$i.')';
            }
            else{
                $requete .= ':id'.$i.',';
            }
        }
        return $requete;
    }
}