<?php
class RequestFactory {
    /**
     * @param ClassLoader.
     *
     * @return Request.
     */
    public static function get_instance(ClassLoader $loader) {
         $loader->load('Request');
         return new Request();
    }
}
