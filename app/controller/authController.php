<?php

namespace app\controller;

use app\core\Session;
use app\tools\Redirect;
use app\core\Csrf;

class AuthController extends Controller
{
    protected Csrf $csrf;

    public function __construct(Session $session)
    {
        parent::__construct($session);
        $this->csrf = new Csrf($session);
    }

    public function route(): void
    {
        try {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'commander':
                        $this->commander();
                    break;
                    case 'connexion':
                        $this->connexion();
                    break;
                    default:
                        throw new \Exception("Cette action n'existe pas : ".$_GET['action']);
                    break;
                }
            } else {
                $this->index();
            }
        } catch(\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }

    protected function commander():void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new \Exception('Méthode de requête invalide.');
        }

        if (!$this->csrf->validate($_POST['csrf_token'] ?? null)) {
            throw new \Exception('Requête invalide.');
        }

        if (!isset($_POST['menuId'])) {
            throw new \Exception('Menu non spécifié.');
        }

        // On conserve le panier
        $this->session->set('panier', $_POST['menuId']);

        if (!$this->session->isAuthenticated()) {

            // Destination après connexion
            $this->session->set(
                'redirect_after_login',
                [
                    'controller' => 'commande',
                    'action' => 'show'
                ]
            );

            Redirect::to('connexion', 'connexion');
        }

        Redirect::to('commande', 'show');
    }

    protected function connexion():void
    {
        $redirect = $this->session->get('redirect_after_login');

        if ($redirect !== null) {

            $this->session->remove('redirect_after_login');

            Redirect::to(
                $redirect['controller'],
                $redirect['action']
            );
        }

        Redirect::to('userpage', 'showCommandes');
    }
}