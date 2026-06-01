<?php

namespace app\repository;

use app\db\Mysql;
use app\entity\menu;

class MenuRepository
{
    public function getAllMenus(){
        try{
            // Appel bdd
            $mysql = mysql::getInstance();
            $pdo = $mysql->getPDO();

            $requete = 'SELECT * FROM menu';
            $query = $pdo->prepare($requete);

            $query->execute();
            $menuListe = [];
            while($menuAnswer = $query->fetch($pdo::FETCH_ASSOC)){
                $newMenu = new Menu;
                array_push($menuListe, $newMenu->fromArray($menuAnswer));
            }
            
            return $menuListe;
        }
        catch(\Exception $e){
            // Gestion des erreurs
        }
    }

    public function getSingleMenu(int $id){
        try{
            // Appel bdd
            $mysql = mysql::getInstance();
            $pdo = $mysql->getPDO();

            $requete = 'SELECT * FROM menu WHERE menu_id = :id';
            $query = $pdo->prepare($requete);
            $query->bindValue(':id', $id, $pdo::PARAM_INT);

            $query->execute();
            
            $newMenu = new Menu;
            $selectedMenu = $newMenu->fromArray($query->fetch($pdo::FETCH_ASSOC));
                
            return $selectedMenu;
        }
        catch(\Exception $e){
            // Gestion des erreurs
        }
    }
}