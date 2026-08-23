<?php

namespace app\controller;

use app\repository\horaireRepository;
use app\core\session;
use app\tools\Redirect;

class Controller
{

    protected Session $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function route():void
    {
        try{
            // On vérifie l'existence du paramètre
            switch($_GET['controller']  ?? 'home'){
                case 'home':
                    // charge le controller home
                    $controller = new HomeController($this->session);
                break;
                case 'menu':
                    // charge le controller menu
                    $controller = new MenuController($this->session);
                break;
                case 'connexion':
                    // charge le controller connexion
                    $controller = new ConnexionController($this->session);
                break;
                case 'userpage':
                    // charge le controller userpage
                    $controller = new UserpageController($this->session);
                break;
                case 'authenticator':
                    // charge le controller d'authentification
                    $controller = new AuthController($this->session);
                break;
                default:
                    throw new \Exception("La page demandée n'existe pas");
                break;
            }
            $controller->route();

        } catch (\Exception $e){
            //Gestion des erreurs
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }

    protected function index():void
    {
        Redirect::to('home','index');
    }

    protected function getHoraire():array
    {
        // Récupération des horaires d'ouverture
        $hoaraireRepository = new HoraireRepository();
        $horaire = $hoaraireRepository->getAllHoraires();

        return $horaire;
    }

    protected function render(string $path, array $params = []):void
    {
        //Chemin du template à afficher
        $filePath = _ROOTPATH_.'/templates/'.$path.'.php';

        try {
            $horaire = $this->getHoraire();
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