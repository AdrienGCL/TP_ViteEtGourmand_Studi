<?php

namespace app\controller;

use app\core\session;
use app\tools\Redirect;

class AuthController extends Controller
{
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
        // On conserve le panier
        $this->session->set('panier', $_GET['menuId']);

        if (!$this->session->isAuthenticated()) {

            // Destination après connexion
            $this->session->set(
                'redirect_after_login',
                [
                    'controller' => 'commande',
                    'action' => 'index'
                ]
            );

            Redirect::to('connexion', 'connexion');
        }

        Redirect::to('commande', 'index');
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