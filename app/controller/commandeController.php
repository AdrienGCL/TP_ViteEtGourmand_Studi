<?php

    namespace app\controller;
    use app\core\Session;
    use app\repository\UserRepository;
    use app\repository\MenuRepository;
    use app\repository\ThemeRepository;
    use app\repository\RegimeRepository;
    use app\repository\PlatRepository;
    use app\repository\EntreeRepository;
    use app\repository\DessertRepository;
    use app\repository\AllergeneRepository;
    use app\repository\CommandeRepository;
    use app\entity\Commande;
    use app\tools\ArrayTools;
    use app\tools\StringTools;
    use app\service\GeocodingService;
    use app\service\DistanceCalculator;
    use app\service\DeliveryService;
    use app\service\OrderService;
    use app\config\DeliveryConfig;
    use app\core\Csrf;
    use app\tools\Redirect;

    class CommandeController extends Controller
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
                        case 'show':
                            $this->show();
                        break;
                        case 'recapCommande':
                            $this->recapCommande();
                        break;
                        case 'reviewCommande':
                            $this->reviewCommande();
                        break;
                        case 'deleteCommande':
                            $this->deleteCommande();
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

                $modifyCommandeId = $this->session->get('modify_commande_id');

                if($modifyCommandeId){
                    $commandeRepository = new CommandeRepository();
                    $commande = $commandeRepository->getCommandeById($modifyCommandeId);
                    $menuId = $commande->getMenu();
                    
                    $this->session->set('oldQuantity', $commande->getQuantite());
                }
                $menu = $menuRepository->getSingleMenu($menuId);

                switch($menu){
                    case false :
                        throw new \Exception("Cher client, le menu séléctionné ne semble plus être disponible.");
                    break;
                    default:
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
                    break;
                }

                if(isset($_POST['commander'])){
                    if (!$this->csrf->validate($_POST['csrf_token'] ?? null)) {
                        throw new \Exception('Requête invalide.');
                    }

                    $prixCommande = $_POST['quantite'] * $menu->getPrix();

                    $geocodingService = new GeocodingService();

                    try {
                        $adresseList = $geocodingService->geocodeAddress(
                            $_POST['adresselivraison'] ?? '',
                            $_POST['cplivraison'] ?? '',
                            $_POST['villelivraison'] ?? ''
                        );

                        if (empty($adresseList)) {
                            throw new \RuntimeException('Aucune correspondance trouvée.');
                        }

                        if(count($adresseList) == 1){
                            // Gérer le cas où une seule adresse est trouvée.

                            $result = $adresseList[0];
                            $properties = $result['properties'];
                            $coordinates = $result['geometry']['coordinates'];
                            $adresseName = $properties['name'];
                            $adresseZipcode = intval($properties['postcode']);
                            $adresseCity = StringTools::toUpperCase($properties['city']);

                            $longitude = $coordinates[0];
                            $latitude = $coordinates[1];

                            $distanceLivraison = DistanceCalculator::calculateDistance($latitude, $longitude, DeliveryConfig::getShopLatitude(), DeliveryConfig::getShopLongitude());
                            $coutLivraison = DeliveryService::calculateDeliveryCost($distanceLivraison, $adresseZipcode);
                            $remiseQuantite = OrderService::calculateQuantityDiscount($_POST['quantite'], $menu->getQuantiteMin(), $menu->getPrix());
                            $prixTtc = OrderService::calculateTotalPrice($menu->getPrix(), $_POST['quantite'], $remiseQuantite, $coutLivraison);

                            if($modifyCommandeId){
                                $commandeRepository = new CommandeRepository();
                                $commande = $commandeRepository->getCommandeById($modifyCommandeId);
                                // $commande->setDateCommande(date('Y-m-d'));
                                $commande->setDateLivraison($_POST['datelivraison']);
                                $commande->setHeureLivraison($_POST['heurelivraison']);
                                $commande->setAdresseLivraison($adresseName);
                                $commande->setCodePostale($adresseZipcode);
                                $commande->setVille($adresseCity);
                                $commande->setQuantite($_POST['quantite']);
                                $commande->setPrix($prixTtc);
                                $commande->setPrixLivraison($coutLivraison);
                                $commande->setRemise($remiseQuantite);
                                // $commande->setMenu($menuId);
                                // $commande->setUser($userId);
                                $commande->setEtat(1);
                            }
                            else{
                                $newCommande = new Commande();
                                $commande = $newCommande->fromArray(
                                    [
                                        'commande_id'=>null,
                                        'date_commande'=>date('Y-m-d'),
                                        'date_livraison'=>$_POST['datelivraison'],
                                        'heure_livraison'=>$_POST['heurelivraison'],
                                        'adresse_livraison'=>$adresseName,
                                        'code_postale'=>$adresseZipcode,
                                        'ville'=>$adresseCity,
                                        'quantite'=>$_POST['quantite'],
                                        'prix_ttc'=>$prixTtc,
                                        'prix_livraison'=>$coutLivraison,
                                        'remise'=>$remiseQuantite,
                                        'materiel'=>null,
                                        'retour_materiel'=>null,
                                        'menu'=>$menuId,
                                        'user'=>$userId,
                                        'etat'=>1
                                    ]
                                );
                            }
                            
                            
                            $this->session->set('commande', $commande);
                            $this->session->set('menu', $menu);

                            Redirect::to('commande', 'recapCommande');
                        }
                        if(count($adresseList) > 1){
                            // Gérer le cas où plusieurs adresses sont trouvées.
                            $this->render('commande/choixAdresse', ['menuId' => $menuId]);
                        }
                        if(count($adresseList) == 0){
                            // Gérer le cas où aucune adresse n'est trouvée.
                            $this->render('errors/adresseError', ['menuId' => $menuId]);
                        }

                    } catch (\InvalidArgumentException $exception) {
                        // Données soumises invalides.

                    } catch (\RuntimeException $exception) {
                        // Erreur API ou absence de résultat.
                    }
                }
                else{
                    // Rendu de la page
                    $this->render('commande/detailCommande', ['user' => $user, 'menu' => $menu, 'theme' => $theme, 'regime' => $regime, 'entree' => $entree, 'plat' => $plat, 'dessert' => $dessert, 'allergenes' => $allergenes, 'commande' => $commande ?? null]);
                }
                
            }
            catch(\Exception $e){
                $this->render('errors/default', [
                    'error' => $e->getMessage()
                ]);
            }
        }

        function recapCommande()
        {
            try{
                $commande = $this->session->get('commande');
                $menu = $this->session->get('menu');
                $modifyCommandeId = $this->session->get('modify_commande_id');
                $oldQuantity = $this->session->get('oldQuantity');

                if(!$commande || !$menu){
                    throw new \Exception("Aucune commande en cours.");
                }

                if(isset($_POST['commander'])){
                    if (!$this->csrf->validate($_POST['csrf_token'] ?? null)) {
                        throw new \Exception('Requête invalide.');
                    }

                    $menuRepository = new MenuRepository();
                    $quantite_disponible = $menuRepository->getMenuQuantity($menu->getId());
                    if($modifyCommandeId){
                        $quantite_disponible += $oldQuantity;
                    }
                    if($commande->getQuantite() > $quantite_disponible){
                        throw new \Exception("La quantité demandée dépasse la quantité disponible.");
                    }
                    else{
                        $newQuantity = $quantite_disponible - $commande->getQuantite();
                        $menuRepository->updateMenuQuantity($menu->getId(), $newQuantity);

                        $commandeRepository = new CommandeRepository();

                        if($modifyCommandeId){
                            $commandeRepository->updateCommande($commande);
                            $this->session->remove('modify_commande_id');
                        }
                        else{
                            $commandeRepository->createCommande($commande);
                        }

                        // Supprimer la commande et le menu de la session après l'enregistrement
                        $this->session->remove('commande');
                        $this->session->remove('menu');

                        // Rediriger vers espace utilisateur après la création de la commande
                        Redirect::to('userpage', 'showCommandes');
                    }
                }
                else{
                    // Rendu de la page
                    $this->render('commande/recapCommande', ['commande' => $commande, 'menu' => $menu]);
                }
            }
            catch(\Exception $e){
                $this->render('errors/default', [
                    'error' => $e->getMessage()
                ]);
            }
        }

        function reviewCommande()
        {
            try{
                $commandeId = $this->session->get('view_commande_id');
                if(!$commandeId){
                    throw new \Exception("Aucune commande sélectionnée.");
                }

                $commandeRepository = new CommandeRepository();
                $commande = $commandeRepository->getCommandeById($commandeId);

                if(!$commande){
                    throw new \Exception("La commande sélectionnée n'existe pas.");
                }

                $menuRepository = new MenuRepository();
                $menu = $menuRepository->getSingleMenu($commande->getMenu());

                if(!$menu){
                    throw new \Exception("Le menu associé à cette commande n'existe pas.");
                }

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

                if(isset($_POST['modifyCommande'])){
                    if (!$this->csrf->validate($_POST['csrf_token'] ?? null)) {
                        throw new \Exception('Requête invalide.');
                    }
                    if(!$commandeRepository->isModifiable($commandeId)) {
                        throw new \Exception("La commande ne peut pas être modifiée.");
                    }
                    $this->session->set('modify_commande_id', $commandeId);
                    $this->session->remove('view_commande_id');
                    Redirect::to('commande', 'show');
                }
                if(isset($_POST['deleteCommande'])){
                    if (!$this->csrf->validate($_POST['csrf_token'] ?? null)) {
                        throw new \Exception('Requête invalide.');
                    }
                    if(!$commandeRepository->isModifiable($commandeId)) {
                        throw new \Exception("La commande ne peut pas être supprimée.");
                    }
                    $this->session->set('delete_commande_id', $commandeId);
                    $this->session->remove('view_commande_id');
                    Redirect::to('commande', 'deleteCommande');
                }

                // Rendu de la page
                $this->render('commande/reviewCommande', ['commande' => $commande, 'menu' => $menu, 'theme' => $theme, 'regime' => $regime, 'entree' => $entree, 'plat' => $plat, 'dessert' => $dessert]);
            }
            catch(\Exception $e){
                $this->render('errors/default', [
                    'error' => $e->getMessage()
                ]);
            }
        }

        function deleteCommande()
        {
            try{
                $commandeId = $this->session->get('delete_commande_id');
                if(!$commandeId){
                    throw new \Exception("Aucune commande sélectionnée.");
                }

                $commandeRepository = new CommandeRepository();
                $commande = $commandeRepository->getCommandeById($commandeId);

                if(!$commande){
                    throw new \Exception("La commande sélectionnée n'existe pas.");
                }

                if(!$commandeRepository->isModifiable($commandeId)) {
                    throw new \Exception("La commande ne peut pas être supprimée.");
                }

                if(isset($_POST['confirmer'])){
                    if (!$this->csrf->validate($_POST['csrf_token'] ?? null)) {
                        throw new \Exception('Requête invalide.');
                    }

                    $commandeRepository->deleteCommande($commandeId);

                    // Supprimer l'identifiant de la commande de la session après la suppression
                    $this->session->remove('delete_commande_id');

                    // Rediriger vers espace utilisateur après la suppression de la commande
                    Redirect::to('userpage', 'showCommandes');
                }
                if(isset($_POST['annuler'])){
                    if (!$this->csrf->validate($_POST['csrf_token'] ?? null)) {
                        throw new \Exception('Requête invalide.');
                    }

                    // Supprimer l'identifiant de la commande de la session après l'annulation
                    $this->session->remove('delete_commande_id');

                    // Rediriger vers espace utilisateur après l'annulation de la suppression
                    Redirect::to('userpage', 'showCommandes');
                }
                
                $this->render('commande/deleteCommande', ['commande' => $commande]);
            }
            catch(\Exception $e){
                $this->render('errors/default', [
                    'error' => $e->getMessage()
                ]);
            }
        }
    }

?>