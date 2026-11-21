<?php

    namespace app\controller;

    use app\repository\UserRepository;
    use app\repository\CommandeRepository;
    use app\repository\EtatCommandeRepository;
    use app\tools\Redirect;
    use app\core\Session;
    use app\core\Csrf;

    class UserpageController extends Controller
    {

        protected Csrf $csrf;

        public function __construct(Session $session)
        {
            parent::__construct($session);
            $this->csrf = new Csrf($session);
        }

        public function route():void
        {
            try {
                if (isset($_GET['action'])) {
                    switch ($_GET['action']) {
                        case 'showCommandes':
                            $this->showCommandes();
                        break;
                        case 'showProfile':
                            $this->showProfile();
                        break;
                        case 'modifyProfile':
                            $this->modifyProfile();
                        break;
                        default:
                            throw new \Exception("Cette action n'existe pas : ".$_GET['action']);
                        break;
                    }
                } else {
                    $this->showCommandes();
                }
            } catch(\Exception $e) {
                $this->render('errors/default', [
                    'error' => $e->getMessage()
                ]);
            }
        }

        protected function showCommandes()
        {
            try{
                $userId = $this->session->get('user_id');

                $userRepository = new UserRepository();
                $user = $userRepository->getUserById($userId);

                $commandeRepository = new CommandeRepository();
                $commandes = $commandeRepository->getCommandeByUserId($userId);

                $etatCommandeRepository = new EtatCommandeRepository();
                $etatCommandes = $etatCommandeRepository->getAllEtatCommande();


                // Rendu de la page
                $this->render('user/userpageCommandes', ['commandes' => $commandes, 'userFirstName' => $user->getPrenom(), 'etatCommandes' => $etatCommandes]);
            }
            catch(\Exception $e){
                $this->render('errors/default', [
                    'error' => $e->getMessage()
                ]);
            }
        }
        
        protected function showProfile()
        {
            try{
                $userId = $this->session->get('user_id');

                $userRepository = new UserRepository();
                $user = $userRepository->getUserById($userId);

                // Rendu de la page
                $this->render('user/userpageProfile', ['user' => $user]);
            }
            catch(\Exception $e){
                $this->render('errors/default', [
                    'error' => $e->getMessage()
                ]);
            }
        }

        protected function modifyProfile()
        {
            try{
                $userId = $this->session->get('user_id');

                $userRepository = new UserRepository();
                $user = $userRepository->getUserById($userId);

                if(isset($_POST['Valider']))
                {
                    if (!$this->csrf->validate($_POST['csrf_token'] ?? null)) {
                        throw new \Exception('Requête invalide.');
                    }
                    // Vérification du mot de passe actuel
                    $mdpValid = $userRepository -> checkMdp($_POST['mail'], $_POST['mdp']);
                    
                    // Si le mdp est faux
                    if($mdpValid === false){
                        $this->render('user/modifyProfile', ['user' => $user, 'csrf' => $this->csrf, 'wrongPassword' => true]);
                    }
                    // Si le mdp est bon
                    else {
                        // Modification des informations de l'utilisateur
                        $userRepository -> updateUser($userId, $_POST['nameregister'], $_POST['firstnameregister'], $_POST['phoneregister'], $_POST['mail'], $_POST['adresseregister'], $_POST['cpregister'], $_POST['villeregister'], $_POST['paysregister'], $_POST['mdpconfirmregister']);
                        
                        // Retour à la page de profil avec les nouvelles informations
                        redirect::to('userpage', 'showProfile');
                    }
                }

                if(isset($_POST['Annuler']))
                {
                    if (!$this->csrf->validate($_POST['csrf_token'] ?? null)) {
                        throw new \Exception('Requête invalide.');
                    }
                    // Retour à la page de profil sans modification
                    redirect::to('userpage', 'showProfile');
                }

                // Rendu de la page
                $this->render('user/modifyProfile', ['user' => $user, 'csrf' => $this->csrf]);
            }
            catch(\Exception $e){
                $this->render('errors/default', [
                    'error' => $e->getMessage()
                ]);
            }
        }
    }

?>