<?php

    namespace app\controller;

use app\entity\avis;
use app\repository;
use app\repository\avisRepository;
use app\repository\userRepository;
use app\tools\StringTools;

    class HomeController extends Controller
    {
        public function route():void
        {
            try {
                if (isset($_GET['action'])) {
                    switch ($_GET['action']) {
                        case 'show':
                            $this->show();
                        break;
                        default:
                            throw new \Exception("Cette action n'existe pas : ".$_GET['action']);
                        break;
                    }
                } else {
                    $this->show();
                }
            } catch(\Exception $e) {
                $this->render('errors/default', [
                    'error' => $e->getMessage()
                ]);
            }
        }

        protected function show()
        {
            try{
                // Récupération des avis
                $avisRepository = new AvisRepository();
                $avis = $avisRepository->findAllByStatut(2, 5); /* Arguments fonction : statut, nb de résultats */

                // Listing des id utilisateurs de chaque avis
                $avisUserId = [];

                foreach($avis as $key){
                    $userId = $key->getUser();
                    if(!in_array($userId, $avisUserId, true)){
                        array_push($avisUserId, $userId);
                    }
                }

                // Récupération des noms/prénoms utilisateurs d'après la liste d'id
                $userRepository = new UserRepository();
                $avisUserList = $userRepository->getUserNameById($avisUserId);
                
                // Assignation des infos utilisateur à chaque avis
                foreach($avisUserList as $elmnt){
                    foreach($avis as $obj){
                        if($elmnt['user_id'] == $obj->getId()){
                            $obj->setUserFirstname($elmnt['prenom']);
                            $obj->setUserName($elmnt['nom']);
                        }
                    }
                }

                // Rendu de la page avec la liste des avis
                $this->render('home/homepage', ['avis' => $avis]);
            }
            catch(\Exception $e){
                $this->render('errors/default', [
                    'error' => $e->getMessage()
                ]);
            }
        }
    }

?>