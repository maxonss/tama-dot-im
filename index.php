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
// Defines the root of the project
define('BASEPATH', '/');
Router::initialization();

Router::run(BASEPATH);