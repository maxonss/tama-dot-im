<?php
// Show error in case of failure
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Load the autoloader
require_once('core/autoloader.php');
require_once('vendor/autoload.php');
// Initialize the connection to the database
Parameter::initialization();
Connect::initialization();
$router = new \Mezon\Router\Router();
Route::initialization($router);
// Loading every needed HTML structure files
require('view/head.php');
require('view/header.php');
$router->callRoute($_SERVER['REQUEST_URI']);
// Load the rest of needed HTML files
require('view/footer.php');
