<?php

spl_autoload_register();

require_once _ROOTPATH_ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(_ROOTPATH_);
$dotenv->load();

session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => false,      // HTTPS uniquement
    'httponly' => true,    // inaccessible en JavaScript
    'samesite' => 'Lax'
]);

use app\core\session;

$session = new Session();
$session->start();