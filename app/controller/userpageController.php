<?php

    namespace app\controller;

    use app\repository\UserRepository;
    use app\repository\CommandeRepository;
    use app\repository\EtatCommandeRepository;
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
    }

?>