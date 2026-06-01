<?php

    namespace app\controller;

    use app\repository\menuRepository;
    use app\repository\themeRepository;
    use app\repository\regimeRepository;
    use app\repository\platRepository;
    use app\repository\entreeRepository;
    use app\repository\dessertRepository;
    use app\repository\allergeneRepository;
    use App\tools\arrayTools;


    class MenuController extends Controller
    {
        public function route():void
        {
            try {
                if (isset($_GET['action'])) {
                    switch ($_GET['action']) {
                        case 'showAll':
                            $this->showAll();
                        break;
                        case 'showOne':
                            $this->showOne();
                        break;
                        default:
                            throw new \Exception("Cette action n'existe pas : ".$_GET['action']);
                        break;
                    }
                } else {
                    $this->showAll();
                }
            } catch(\Exception $e) {
                $this->render('errors/default', [
                    'error' => $e->getMessage()
                ]);
            }
        }

        protected function showAll()
        {
            try{
                $menuRepository = new MenuRepository;
                $menus = $menuRepository->getAllMenus();

                $themeRepository = new ThemeRepository;
                $themes = $themeRepository->getAllTheme();

                $regimeRepository = new RegimeRepository;
                $regimes = $regimeRepository->getAllRegime();

                // Rendu de la page avec la liste des avis
                $this->render('menu/menupage', ['menus' => $menus, 'themes' => $themes, 'regimes' => $regimes]);
            }
            catch(\Exception $e){
                $this->render('errors/default', [
                    'error' => $e->getMessage()
                ]);
            }
        }

        protected function showOne()
        {
            try{
                if(isset($_GET['id'])){

                    // Récupérer le menu
                    $menuRepository = new MenuRepository;
                    $menu = $menuRepository->getSingleMenu($_GET['id']);

                    // Récupérer le thème
                    $themeRepository = new ThemeRepository;
                    $theme = $themeRepository->getSingleTheme($menu->getTheme());

                    // Récupérer le régime
                    $regimeRepository = new RegimeRepository;
                    $regime = $regimeRepository->getSingleRegime($menu->getRegime());

                    // Récupérer l'entrée
                    $entreeRepository = new EntreeRepository;
                    $entree = $entreeRepository->getSinglePlat($menu->getEntree());

                    // Récuppérer le plat principal
                    $platRepository = new PlatRepository;
                    $plat = $platRepository->getSinglePlat($menu->getPlat());

                    // Récupérer le dessert
                    $dessertRepository = new DessertRepository;
                    $dessert = $dessertRepository->getSinglePlat($menu->getDessert());

                    // Récupérer les allergènes par plat
                    $allergeneRepository = new AllergeneRepository;
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


                    // Rendu de la page de menu détaillée
                    $this->render('menu/menudetail', ['menu' => $menu, 'theme' => $theme, 'regime' => $regime, 'entree' => $entree, 'plat' => $plat, 'dessert' => $dessert, 'allergenes' => $allergenes]);
                }
                else {
                    throw new \Exception("Aucun menu sélectionné !");
                }
            }
            catch(\Exception $e){
                $this->render('errors/default', [
                    'error' => $e->getMessage()
                ]);
            }
        }
    }

?>