<?php
class FrontController {

    /**
     * @var $loader ClassLoader.
     */
    protected $loader = null;

    /**
     * @var request Request represent an Http request.
     */
    protected static $request = null;

    /**
     * @var response Response is a response object.
     */
    protected static $response = null;

    /**
     * Create a FrontController instance.
     *
     * @param ClassLoader.
     */
    function __construct($loader) {
        $this->loader             = $loader;
        FrontController::$request = $loader->get('Request');
    }

    /**
     * @return Request.
     */
    public static function get_request(){
        return FrontController::$request;
    }

    /**
     * Run the application.
     * Parse url and choose the controller which to invoke.
     */
    function run() {
        $this->loader->get('Router')->route();
    }
}
