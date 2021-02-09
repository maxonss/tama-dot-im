<?php
/**
 * Database core class. Opens a connection between the app and the database
 * 
 * Connect class only contains one attribute :
 *  - PDO object
 * @access private
 */
class Connect 
{
    /**
     * @var object
     */
    private static $_db;
    /**
     * @static
     * @return object
     */
    public static function getDb() {
        return self::$_db;
    }
    /**
     * Opens a connection between the app and its database
     * 
     * Tries to instaciate a `PDO`object with creditentials "*got*"
     * by the `Parameter` class (explicitly read by the `Parameter` class)
     */
    public static function initialization() {
        try {
            // Tries to instanciate a new connection
            self::$_db = new PDO (
                'mysql:host=' . Parameter::getHost() . '; port=' . Parameter::getPort() . '; dbname=' . Parameter::getDbName() . '; charset=utf8', Parameter::getUsername(), Parameter::getPassword()
            );
        } catch (Exception $e) {
            // Show the error in case of failure
            die("Error: " . $e->getMessage());
        }
    }
}