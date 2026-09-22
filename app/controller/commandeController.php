<?php

    namespace app\controller;
    use app\repository\UserRepository;
    use app\repository\MenuRepository;
    use app\repository\ThemeRepository;
    use app\repository\RegimeRepository;
    use app\repository\PlatRepository;
    use app\repository\EntreeRepository;
    use app\repository\DessertRepository;
    use app\repository\AllergeneRepository;
    use app\tools\ArrayTools;

    class CommandeController extends Controller
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

                $userRepository = new UserRepository();
                $userId = $this->session->getUserId();
                $user = $userRepository->getUserById($userId);

                // Récupérer le menu
                $menuRepository = new MenuRepository();
                $menuId = $this->session->get('panier');
                $menu = $menuRepository->getSingleMenu($menuId);

                // Récupérer le thème
                $themeRepository = new ThemeRepository();
                $theme = $themeRepository->getSingleTheme($menu->getTheme());

                // Récupérer le régime
                $regimeRepository = new RegimeRepository();
                $regime = $regimeRepository->getSingleRegime($menu->getRegime());

                // Récupérer l'entrée
                $entreeRepository = new EntreeRepository();
                $entree = $entreeRepository->getSinglePlat($menu->getEntree());

                // Récuppérer le plat principal
                $platRepository = new PlatRepository();
                $plat = $platRepository->getSinglePlat($menu->getPlat());

                // Récupérer le dessert
                $dessertRepository = new DessertRepository();
                $dessert = $dessertRepository->getSinglePlat($menu->getDessert());

                // Récupérer les allergènes par plat
                $allergeneRepository = new AllergeneRepository();
                $allergenesEntree = $allergeneRepository->getPlatAllergenes($menu->getEntree(), 'entree');
                $allergenesPlat = $allergeneRepository->getPlatAllergenes($menu->getPlat(), 'plat');
                $allergenesDessert = $allergeneRepository->getPlatAllergenes($menu->getDessert(), 'dessert');

                $allergenesIdList = [];

                // Regroupement et optimisation des id des allergènes en une seule liste
                $allergenesIdList = ArrayTools::addFromArray($allergenesEntree, $allergenesIdList);
                $allergenesIdList = ArrayTools::addFromArray($allergenesPlat, $allergenesIdList);
                $allergenesIdList = ArrayTools::addFromArray($allergenesDessert, $allergenesIdList);

                // Récupérer les allergènes à partir dela liste des id
                $allergenes = $allergeneRepository->getAllergenesById($allergenesIdList);
                

                // Rendu de la page avec la liste des avis
                $this->render('commande/recapCommande', ['user' => $user, 'menu' => $menu, 'theme' => $theme, 'regime' => $regime, 'entree' => $entree, 'plat' => $plat, 'dessert' => $dessert, 'allergenes' => $allergenes]);
            }
            catch(\Exception $e){
                $this->render('errors/default', [
                    'error' => $e->getMessage()
                ]);
            }
        }
    }

?>