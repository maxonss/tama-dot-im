<?php
/**
 * Automatically loads all the needed Database/Controller/Model classes
 */
function autoloader($className) {
    if ($className !== "Router"){
        if (file_exists("core/database/$className.php")) {
            require_once("core/database/$className.php");
        }
        if (file_exists("core/$className.php")) {
            require_once("core/$className.php");
        }
        if (file_exists("controller/$className.Controller.php")) {
            require_once("controller/$className.Controller.php");
        }
        if (file_exists("model/$className.php")) {
            require_once("model/$className.php");
        }
    }
}
spl_autoload_register('autoloader');