<?php

namespace app\repository;

use app\db\Mysql;
use app\entity\Menu;

class MenuRepository
{
    public function getAllMenus(){
        try{
            // Appel bdd
            $mysql = Mysql::getInstance();
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
            $mysql = Mysql::getInstance();
            $pdo = $mysql->getPDO();

            $requete = 'SELECT * FROM menu WHERE menu_id = :id';
            $query = $pdo->prepare($requete);
            $query->bindValue(':id', $id, $pdo::PARAM_INT);

            $query->execute();
            
            $newMenu = new Menu;
            $brutResponse = $query->fetch($pdo::FETCH_ASSOC);

            if(!$brutResponse){
                return $brutResponse;
            }
            $selectedMenu = $newMenu->fromArray($brutResponse);
            
            return $selectedMenu;
        }
        catch(\Exception $e){
            // Gestion des erreurs
        }
    }

    public function checkMenu(int $id):bool
    {
        // Appel bdd
        $mysql = Mysql::getInstance();
        $pdo = $mysql->getPDO();

        $requete = 'SELECT COUNT(*) FROM menu WHERE menu_id = :id';
        $query = $pdo->prepare($requete);
        $query->bindValue(':id', $id, $pdo::PARAM_INT);

        $query->execute();

        $menuCount = $query->fetch($pdo::FETCH_ASSOC);

        if($menuCount["COUNT(*)"] != 0){
            return true;
        }
        else {
            return false;
        }
    }
}