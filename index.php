<?php
// Show error in case of failure
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Load the autoloader
require_once('core/autoloader.php');
// Initialize the connection to the database
Parameter::initialization();
Connect::initialization();

/**
 * Loads the needed page
 * @param array $p tableau associatif contenant les informations relatives à la page
 */
// function pageLoader($p, $debug = false, $debug_routes = null)
// {
//     $path  =  $p[0];
//     $name  =  $p[1];
//     $title =  $p[2];

//     include "view/head.php";
//     include "view/header.php";
//     include "view$path/$name.php";
//     include "view/footer.php";   
// }

// $routes = [
//     '/'       => ['', 'homepage', 'Welcome'],
//     'default' => ['', 'homepage', 'Welcome'],
//     '404'     => ['', '404-not-found', 'Oups'],
//     'users'   => ['', 'list', 'User list'],
//     'posts'   => ['', 'posts', 'Posts list']
// ];

// if (isset($_GET, $_GET['p'])) {
//     $p = $_GET['p'];
//     if (isset($routes[$p])) {
//         pageLoader($routes[$p]);
//     } else {
//         pageLoader($routes['default']);
//     }
// } else {
//     pageLoader($routes['default']);
// }