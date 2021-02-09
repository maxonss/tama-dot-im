<?php

/**
 * Contoller for the User's class
 */
class User
{
    /**
     * @var int
     */
    private $_id;

    /**
     * @var string
     */
    public $_first_name;

    /**
     * @var string
     */
    private $_last_name;

    /**
     * @var string
     */
    public $_username;

    /**
     * @var string hashed password using `PASSWORD_BCRYPT` method
     * @access private
     */
    private $_password;

    /**
     * @var int
     */
    private $_type_id;
    
    /**
     * @var \DateTime
     */
    private $_date_of_birth;
    /**
     * @var \DateTime
     */
    private $_registration_date;
    /**
     * @var int (0 => false; 1 => true)
     */
    private $_is_logged_in;
    /**
     * @var string
     */
    private $_2fa_token;

    public function getId(): int
    {
        return $this->_id;
    }
    public function setId($_id)
    {
        return $this->_id = $_id;
    }
    public function getFirstName()
    {
        return $this->_first_name;
    }
    public function setFirstName($_first_name)
    {
        return $this->_first_name = $_first_name;
    }
    public function getLastName()
    {
        return $this->_last_name;
    }
    public function setLastName($_last_name)
    {
        return $this->_last_name = $_last_name;
    }
    public function getUsername()
    {
        return $this->_username;
    }
    public function setUsername($_username)
    {
        return $this->_username = $_username;
    }
    public function getPassword()
    {
        return $this->_password;
    }
    public function setPassword($_password)
    {
        return $this->_password = $_password;
    }
    public function getTypeId()
    {
        return $this->_type_id;
    }
    public function setTypeId($_type_id)
    {
        return $this->_type_id = $_type_id;
    }
    public function getDateOfBirth()
    {
        return $this->_date_of_birth;
    }
    public function setDateOfBirth($_date_of_birth)
    {
        return $this->_date_of_birth = $_date_of_birth;
    }
    public function getRegistrationDate()
    {
        return $this->_registration_date;
    }
    public function setRegistrationDate($_registration_date)
    {
        return $this->_registration_date = $_registration_date;
    }
    public function getIsLoggedIn()
    {
        return $this->_is_logged_in;
    }
    public function setIsLoggedIn($_is_logged_in)
    {
        return $this->_is_logged_in = $_is_logged_in;
    }
    public function get2faToken()
    {
        return $this->_2fa_token;
    }
    public function set2faToken($_2fa_token)
    {
        return $this->_2fa_token = $_2fa_token;
    }
    public function __construct(array $options = [])
    {
        if (!empty($options)) {
            $this->hydrate($options);
        }
    }
    /**
     * Automates the creation of User object
     * 
     * Uses all the keys sent in parameter to call their *set()* method of the same name
     * 
     * @param array $datas groups each attribute of a User object, associated to its specific key
     */
    public function hydrate($datas)
    {
        // camel_case to pascalCase
        foreach ($datas as $key => $value) { /* scanning the given array */
            // Removes every underscores of each key and adds an uppercase character at each word
            $key = preg_replace_callback('/_[a-z]?/', (function ($matches) { 
                return strtoupper(ltrim($matches[0], "_"));                  
            }), $key);
            // Initializes the function name as a string
            $method = "set" . $key;
            
            if (is_callable(([$this, $method]))) { /* If the function exists in the class and is callable */
                // Calls the method and sets the value associated to the current key
                $this->$method($value);
            }
        }
    }
}
