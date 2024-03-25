<?php

namespace abahrami13\facades;

abstract class Facade
{
    abstract protected static function getFacadeAccessor();

    public static function __callStatic($method, $arguments)
    {
        $instance = static::getFacadeRoot();
        return call_user_func_array([$instance, $method], $arguments);
    }

    protected static function getFacadeRoot()
    {
        return static::resolveFacadeInstance(static::getFacadeAccessor());
    }

    protected static function resolveFacadeInstance($accessor)
    {
        return is_object($accessor)
            ? $accessor
            : (new $accessor);
    }
}
