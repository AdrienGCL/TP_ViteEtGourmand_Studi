<?php

    namespace app\controller;

    use app\repository\userRepository;
    use app\core\session;

    class UserpageController extends Controller
    {
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

                // Rendu de la page
                $this->render('user/userpage', []);
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

                // Rendu de la page
                $this->render('user/userpage', []);
            }
            catch(\Exception $e){
                $this->render('errors/default', [
                    'error' => $e->getMessage()
                ]);
            }
        }
    }

?>