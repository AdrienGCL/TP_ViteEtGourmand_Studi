<?php

namespace app\repository;

use app\entity\User;
use app\Db\Mysql;
use app\tools\requestTools;
use app\tools\StringTools;
use Exception;

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

    // Verifie l'existence d'un utilitsateur
    public function checkExistingUser(string $mail)
    {
        try{
            // Appel bdd
            $mysql = mysql::getInstance();
            $pdo = $mysql->getPDO();

            $requete = 'SELECT mail FROM user WHERE mail = :email';

            $query = $pdo->prepare($requete);
            
            // bindvalue
            $query->bindValue(':email', $mail, $pdo::PARAM_STR); 
            
            $query->execute();
            $userAnswer = $query->fetch($pdo::FETCH_ASSOC);
            
            if($userAnswer){
                return true;
            }
            else{
                return false;
            }
        }
        catch(\Exception $e){
            // Gestion des erreurs
        }
    }

    // Vérifie mdp
    public function checkMdp(string $mail, string $mdp)
    {
        try{
            // Appel bdd
            $mysql = mysql::getInstance();
            $pdo = $mysql->getPDO();

            $requete = 'SELECT * FROM user WHERE mail = :email';

            $query = $pdo->prepare($requete);
            
            // bindvalue
            $query->bindValue(':email', $mail, $pdo::PARAM_STR);

            $query->execute();

            $userAnswer = $query->fetch($pdo::FETCH_ASSOC);
            if(password_verify($mdp, $userAnswer['password'])){
                $user = new user;
                $user->fromArray($userAnswer);

                return $user;
            }
            else{
                throw new \Exception("Le mot de passe est incorrect");
            }
        }
        catch(\Exception $e){
            // Gestion des erreurs
            return false;
        }
    }

    // Création d'un nouvel utilisateur
    public function newUser(string $nom, string $prenom, string $telephone, string $email, string $adresse, int $cp, string $ville, string $pays, string $mdp)
    {
        try{
            // Appel bdd
            $mysql = mysql::getInstance();
            $pdo = $mysql->getPDO();

            $requete = 'INSERT INTO user (prenom, nom, telephone, mail, adresse, code_postale, ville, pays, password) VALUES (:prenom, :nom, :phone, :email, :adresse, :cp, :ville, :pays, :mdp)';
            $query = $pdo->prepare($requete);
            
            $password = password_hash($mdp, PASSWORD_DEFAULT);

            // bindvalue
            $query->bindValue(':prenom', $prenom, $pdo::PARAM_STR);
            $query->bindValue(':nom', $nom, $pdo::PARAM_STR);
            $query->bindValue(':phone', $telephone, $pdo::PARAM_STR);
            $query->bindValue(':email', $email, $pdo::PARAM_STR);
            $query->bindValue(':adresse', $adresse, $pdo::PARAM_STR);
            $query->bindValue(':cp', $cp, $pdo::PARAM_INT);
            $query->bindValue(':ville', StringTools::toUpperCase($ville), $pdo::PARAM_STR);
            $query->bindValue(':pays', StringTools::toUpperCase($pays), $pdo::PARAM_STR);
            $query->bindValue(':mdp', $password, $pdo::PARAM_STR);

            $query->execute();

            $newUserAnswer = $query->fetch($pdo::FETCH_ASSOC);

            return $newUserAnswer;

        }
        catch(\Exception $e){
            // Gestion des erreurs
        }
    }
}