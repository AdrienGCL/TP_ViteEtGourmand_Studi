<?php

define('_ROOTPATH_', __DIR__);

require_once __DIR__ . '/config/bootstrap.php';

use app\controller\controller;

$controller = new Controller($session);
$controller->route();

?>