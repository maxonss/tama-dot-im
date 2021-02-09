<?php
// Show error in case of failure
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('core/autoloader.php');

Parameter::initialization();
Connect::initialization();
