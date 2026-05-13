<?php

namespace app\repository;

use app\entity\theme;
use app\Db\mysql;

class ThemeRepository
{
    public function getAllTheme(){
        try{
            // Appel bdd
            $mysql = mysql::getInstance();
            $pdo = $mysql->getPDO();

            $requete = 'SELECT * FROM theme';
            $query = $pdo->prepare($requete);

            $query->execute();

            $themeListe = [];
            while($themeAnswer = $query->fetch($pdo::FETCH_ASSOC)){
                $newTheme = new Theme;
                array_push($themeListe, $newTheme->fromArray($themeAnswer));
            }
            
            return $themeListe;
        }
        catch(\Exception $e){
            // Gestion des erreurs
        }
    }
}