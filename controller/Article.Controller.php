<?php
class Article
{
    /**
     * @var int
     */
    public $_id;
    /**
     * @var int
     */
    public $_metadatas_id;
    /**
     * @var string
     */
    public $_slug;
    /**
     * @var string
     */
    public $_title;
    /**
     * @var string
     */
    public $_short_description;
    /**
     * @var int
     */
    public $_preview_image_id;
    /**
     * @var int
     */
    public $_writer_id;
    /**
     * @var \DateTime/
     */
    public $_date_created;
    /**
     * @var \DateTime/
     */
    public $_date_published;
    /**
     * @var int
     */
    public $_is_published;
    /**
     * @var int
     */
    public $_updater_id;
    /**
     * @var \timestamp
     */
    public $_date_updated;

    public function getId()
    {
        return $this->_id;
    }
    public function setId($_id)
    {
        return $this->_id = $_id;
    }
    public function getMetadatasId()
    {
        return $this->_metadatas_id;
    }
    public function setMetadatasId($_metadatas_id)
    {
        return $this->_metadatas_id = (int) $_metadatas_id;
    }
    public function getSlug(): string
    {
        return $this->_slug;
    }
    public function setSlug(string $_slug): string
    {
        return $this->_slug = $_slug;
    }
    public function getTitle(): string
    {
        return $this->_title;
    }
    public function setTitle(string $_title): string
    {
        return $this->_title = $_title;
    }
    public function getShortDescription()
    {
        return $this->_short_description;
    }
    public function setShortDescription($_short_description)
    {
        return $this->_short_description = $_short_description;
    }
    public function getPreviewImageId()
    {
        return $this->_preview_image_id;
    }
    public function setPreviewImageId($_preview_image_id)
    {
        return $this->_preview_image_id = $_preview_image_id;
    }
    public function getWriterId()
    {
        return $this->_writer_id;
    }
    public function setWriterId($_writer_id)
    {
        return $this->_writer_id = $_writer_id;
    }
    public function getDateCreated()
    {
        return $this->_date_created;
    }
    public function setDateCreated($_date_created)
    {
        return $this->_date_created = $_date_created;
    }
    public function getDatePublished()
    {
        return $this->_date_published;
    }
    public function setDatePublished($_date_published)
    {
        return $this->_date_published = $_date_published;
    }
    public function getIsPublished()
    {
        return $this->_is_published;
    }
    public function setIsPublished($_is_published)
    {
        return $this->_is_published = $_is_published;
    }
    public function getUpdaterId()
    {
        return $this->_updater_id;
    }
    public function setUpdaterId($_updater_id)
    {
        return $this->_updater_id = $_updater_id;
    }
    public function getDateUpdated()
    {
        return $this->_date_updated;
    }
    public function setDateUpdated($_date_updated)
    {
        return $this->_date_updated = $_date_updated;
    }

    public function __construct(array $options = [])
    {
        if (!empty($options)) {
            $this->hydrate($options);
        }
    }

    /**
     * Automates the creation of Article object
     * 
     * Uses all the keys sent in parameter to call their *set()* method of the same name
     * 
     * @param array $datas groups each attribute of a User object, associated to its specific key
     */
    public function hydrate(array $datas)
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

    /**
     * Format the given date to put it in the link
     * given date: "2021-01-01 12:00:00" becomes "2021/01/01/"
     * @param string $date the date to format
     */
    public function getFullLink():string{
                $formattedDate = str_replace("-", "/", $this->getDatePublished());
                return substr($formattedDate, 0, strpos($formattedDate, " "))."/".$this->getSlug()."/";
    }

    public function getDatePublishedFormatted(): string{
        return substr($this->getDatePublished(), 0, strpos($this->getDatePublished(), " "));
    }
}
