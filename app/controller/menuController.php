<?php

    namespace app\controller;

    use app\repository\menuRepository;
    use app\repository\themeRepository;
    use app\repository\regimeRepository;


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
    }

?>