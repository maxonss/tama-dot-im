<?php

/**
 * Database core class. Contains every parameter to let the app connect to the database
 * 
 * Parameter class is defined by the following attributes :
 *  - server host (the server where the project is hosted)
 *  - listening port accessible by the client
 *  - database name
 *  - username of the virtual user embodied by the application
 *  - password of the virtual user
 * @access private
 */
class Parameter
{
    /**
     * @static
     * @var string
     */
    private static $_host;
    /**
     * @static
     * @var string
     */
    private static $_port;
    /**
     * @static
     * @var string
     */
    private static $_db_name;
    /**
     * @static
     * @var string
     */
    private static $_username;
    /**
     * @static
     * @var string
     */
    private static $_password;

    public static function getHost()
    {
        return self::$_host;
    }
    public static function getPort()
    {
        return self::$_port;
    }
    public static function getDbName()
    {
        return self::$_db_name;
    }
    public static function getUsername()
    {
        return self::$_username;
    }
    public static function getPassword()
    {
        return self::$_password;
    }
    /**
     * Reads the creditentials located in `config/database.ini`
     * and set the to the class attibutes
     */
    public static function init()
    {
        if (file_exists('config/database.ini')) { /* creditentials file exists at the asked path */
            // File name assigned to a variable
            $file_name = "config/database.ini";
        } else { /* creditentials file has not been created */
            // File name set to false
            $file_name = false;
        }

        if ($file_name) { /* file name has been initialized */
            // Open the file in read-only mode
            $flux = fopen($file_name, 'r');
            while (!feof($flux)) { /* while there are still lines to read */
                // Read the content of the current line
                $line = fgets($flux, 50);
                if ($line) { /* the current line is not empty nor null(?) */
                    // Explode the line and get the strings before/after the delimiter
                    $values = explode(':', $line);
                    // Assignment to the array we'll use to assign our attribute to
                    $params[$values[0]] = rtrim($values[1]);
                }
            }
            self::$_host = $params['host'];
            self::$_port = $params['port'];
            self::$_db_name = $params['db_name'];
            self::$_username = $params['username'];
            self::$_password = $params['password'];
        } else { /* file name has not been initialized or not found */
            echo "<code>database.ini</code> not found";
        }
    }
}
