<?php
class RouterFactory {
    /**
     * @return Router.
     */
    static function get_instance(ClassLoader $loader) {
        $loader->load('Router');
        return new Router();
    }
}
