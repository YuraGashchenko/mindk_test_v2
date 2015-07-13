<?php
class Router {

    /**
     * Route http request from url to filesystem.
     */
    public function route() {
        $url_decoded_array = explode('/', $_SERVER['REQUEST_URI']);
        $module            = $url_decoded_array[1];
        $controller        = $url_decoded_array[2];
        $action            = $url_decoded_array[3];
        require $module . '/' . $controller . 'Controller.php';
        $controller = $controller . 'Controller';
        $controller::{$action . 'Action'}();
    }
}
