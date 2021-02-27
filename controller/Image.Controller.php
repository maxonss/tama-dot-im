<?php
class Image
{
    /**
     * @var int
     */
    private $_id;
    /**
     * @var string
     */
    private $_file_name;
    /**
     * @var int
     */
    private $_extension_id;
    /**
     * @var string
     */
    private $_alt_text;
    /**
     * @var string
     */
    private $_full_path_to_image;

    public function getId()
    {
        return $this->_id;
    }
    public function setId($_id)
    {
        return $this->_id = $_id;
    }
    public function getFileName()
    {
        return $this->_file_name;
    }
    public function setFileName($_file_name)
    {
        return $this->_file_name = $_file_name;
    }
    public function getExtensionId()
    {
        return $this->_extension_id;
    }
    public function setExtensionId($_extension_id)
    {
        return $this->_extension_id = $_extension_id;
    }
    public function getAltText()
    {
        return $this->_alt_text;
    }
    public function setAltText($_alt_text)
    {
        return $this->_alt_text = $_alt_text;
    }
    public function getFullPathToImage(): string
    {
        return $this->_full_path_to_image;
    }
    public function setFullPathToImage($_full_path_to_image)
    {
        return $this->_full_path_to_image = $_full_path_to_image;
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
