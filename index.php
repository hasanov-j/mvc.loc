  <?php

// ini_set('error_reporting', E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

require 'vendor\\autoload.php';

require_once 'config\const.php';

//var_dump();die;

$router = new \App\Components\Router();
$router->run();
