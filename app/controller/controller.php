<?php

namespace app\controller;

class Controller
{
    public function route():void
    {
        try{
            if(isset($_GET['controller'])){
                // On vérifie l'existence du paramètre
                switch($_GET['controller']){
                    case 'home':
                        // charge le controller home
                        $homeController = new HomeController();
                        $homeController->route();
                    break;
                    default:
                        throw new \Exception("La page demandée n'existe pas");
                    break;
                }
            }
            else {
                //Chargement de la page d'accueil en absence de paramètre
                $homeController = new HomeController();
                $homeController->route();
            }

        } catch (\Exception $e){
            //Gestion des erreurs
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }

    protected function render(string $path, array $params = []):void
    {
        //Chemin du template à afficher
        $filePath = _ROOTPATH_.'/templates/'.$path.'.php';

        try {
            if (!file_exists($filePath)) {
                // Si le fichier n'existe pas
                throw new \Exception("Fichier non trouvé : ".$filePath);
            } else {
                // Extrait chaque ligne du tableau en argument et crée des variables pour chacune
                extract($params);
                require_once $filePath;
            }
        } catch(\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }

    }
};

?>