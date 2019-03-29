<?php 
ini_set('display_errors', 1);
define('WEBROOT', dirname(__FILE__));
define('ROOT', dirname(WEBROOT));
define('DS', DIRECTORY_SEPARATOR);
define('CORE', ROOT . DS . 'core');
define('BASE_URL', dirname(dirname($_SERVER['SCRIPT_NAME'])));
define('URLROOT', 'https://scolnet.000webhostapp.com/webroot');
define('SCOLNET', 'https://scolnet.000webhostapp.com/');
require CORE . DS . 'includes.php';

new Dispatcher();

?>
