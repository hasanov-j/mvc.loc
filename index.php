  <?php
  ini_set('session.auto_start', 1);
// ini_set('error_reporting', E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

require "vendor".DIRECTORY_SEPARATOR."autoload.php";

require_once "config".DIRECTORY_SEPARATOR."const.php";

$router = new \App\Components\Router();
$router->run();
