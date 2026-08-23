<?php

namespace app\controller;

use app\repository\userRepository;
use app\core\session;
use app\controller\UserpageController;
use app\tools\Redirect;

class ConnexionController extends Controller
{
    public function route():void
    {
        try {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'connexion':
                        $this->connexion();
                    break;
                    case 'inscription':
                        $this->inscription();
                    break;
                    case 'deconnexion':
                        $this->deconnexion();
                    break;
                    default:
                        throw new \Exception("Cette action n'existe pas : ".$_GET['action']);
                    break;
                }
            } else {
                // charge le controller home
                $homeController = new HomeController($this->session);
                $homeController->route();
            }
        } catch(\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }

    protected function connexion()
    {
        // Connexion
            // Vérification de l'envoi du formulaire
            if(isset($_POST['loginUser'])){
                $userRepository = new userRepository();
                $existingUser = $userRepository -> checkExistingUser($_POST['identifiant']);
                // Si l'utilisateur existe
                if($existingUser){
                    $user = $userRepository -> checkMdp($_POST['identifiant'], $_POST['mdp']);
                    
                    // Si le mdp est faux
                    if($user === false){
                        $this->render('user/connexion', ['wrongPassword' => true]);
                    }
                    // Si le mdp est bon
                    else {
                        // Vérification du statut du compte
                        $isAutorised = $user->verifyStatut();
                        switch($isAutorised){
                            case true:
                                session_regenerate_id(true);
                                $this->session->login($user);
                                Redirect::to('authenticator', 'connexion');
                                break;
                            case false:
                                $this->render('errors/default', [
                                    'error' => "Cher client, ce compte est malheureusement suspendu, merci de bien vouloir nous contacter pour plus d'informations."
                                ]);
                                break;
                        }
                    }
                }
                // Si l'utilisateur n'existe pas
                else{
                    $this->render('user/connexion', ['existingUser' => $existingUser]);
                }
            }
            else{
                if($this->session->isAuthenticated()){
                    Redirect::to('authenticator', 'connexion');
                }
                else{
                    $this->render('user/connexion', []);
                }
            }
    }

    protected function inscription()
    {
        // Inscription
            // Vérification de l'envoi du formulaire
            if (isset($_POST['Signin'])){
                $userRepository = new userRepository();
                // Vérifie si l'utilisateur existe déjà
                $existingUser = $userRepository -> checkExistingUser($_POST['mail']);
                if($existingUser){
                    $this->render('user/inscription', ['existingUser' => $existingUser]);
                }
                else{
                    $newUser = $userRepository->newUser($_POST['nameregister'], $_POST['firstnameregister'],$_POST['phoneregister'],$_POST['mail'],$_POST['adresseregister'],$_POST['cpregister'],$_POST['villeregister'],$_POST['paysregister'],$_POST['mdpregister']);
                    $this->render('user/confirmInscription', []);
                }
                
            }
            else{
                $this->render('user/inscription', []);
            }
    }

    protected function deconnexion()
    {
        $this->session->logout();
        Redirect::to('connexion', 'connexion');
    }
}