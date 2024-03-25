<?php

namespace abahrami13\facades;


class RegisterFacadeAutoloader
{
    protected static $facadeNamespace = 'facades\\';

    public function __construct()
    {
        spl_autoload_register(function ($className) {
            if (
                static::$facadeNamespace
                && strpos($className, static::$facadeNamespace) === 0
            ) {
                static::loadFacade($className);
            }
        });
    }

    protected static function loadFacade($className)
    {
        require (new FacadeFileHandler())->ensureFacadeExists($className);
    }

    public static function getFacadeNamespace()
    {
        return static::$facadeNamespace;
    }
}
