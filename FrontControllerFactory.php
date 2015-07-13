<?php
class FrontControllerFactory {
    /**
     * @return FrontController.
     */
    static function get_instance(ClassLoader $loader) {
        $loader->load('FrontController');
        return new FrontController($loader);
    }
}
