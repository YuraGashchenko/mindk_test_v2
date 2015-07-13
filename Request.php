<?php
class Request {

    /**
     * @var array $attributes is the main request attributes.
     */
    private $attributes = array();

    /**
     * Fillfull $attrubutes array with $_SERVER, $_GET, $_POST, $_COOKIE
     * $_FILES superglobals.
     */
    public function __construct() {
        $this->attributes = array_merge($_SERVER, $_GET);
        $this->attributes = array_merge($this->attributes, $_POST);
        $this->attributes = array_merge($this->attributes, $_COOKIE);
        $this->attributes = array_merge($this->attributes, $_FILES);
    }

    /**
     * @return mixed Return value of the request attribute.
     */
    public function get($attr_name){
        return $this->attributes[$attr_name];
    }
}
