<?php

class View {

    /**
     * @var array Hidden fields - is an array of fields withc sets from
     * outside.
     */
    private $hidden_fields = array();

    public function __construct($page = '', array $parameters) {
        foreach ($parameters as $name => $value) {
            $this->hidden_fields[$name] = $value;
        }
        require 'View/' . $page . '.phtml';
    }
}
