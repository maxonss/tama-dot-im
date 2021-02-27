<?php
class UserType
{
    /**
     * @var int
     */
    public $_id;
    /**
     * @var string
     */
    public $_name;

    /**
     * type identifier
     */
    public function getId()
    {
        return $this->_id;
    }
    public function setId($_id)
    {
        return $this->_id = $_id;
    }
    /**
     * @return string user type name
     */
    public function getName(): string
    {
        return $this->_name;
    }
    public function setName($_name)
    {
        return $this->_name = $_name;
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
