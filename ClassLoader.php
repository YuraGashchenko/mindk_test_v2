<?php
class ClassLoader {

    /**
     * @var array $factories is the array of framework factories.
     */
    private $factories = array(
                            'FrontController' => 'FrontControllerFactory',
                            'Request'         => 'RequestFactory',
                            'Router'          => 'RouterFactory'
                            );

    /**
     * @param string $class a class name to load.
     */
    public function load($class) {
        require_once $class . '.php';
    }

    /**
     * @param string $class Name of the class whitch need to be loaded.
     */
    public function get($class) {
        require $this->factories[$class] . '.php';
        return call_user_func($class . 'Factory::get_instance', $this);
    }
}
