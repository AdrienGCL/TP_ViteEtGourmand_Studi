<?php

define('_ROOTPATH_', __DIR__);

spl_autoload_register();

require_once _ROOTPATH_ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use app\controller\controller;

$controller = new Controller();
$controller->route();

?>