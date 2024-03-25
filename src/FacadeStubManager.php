<?php

namespace abahrami13\facades;

class FacadeStubManager
{
    protected static $stubsDir = __DIR__ . '/stubs/';

    public static function getStubPath(
        $className,
        $accessorResolver = FacadeAccessorResolver::class
    ) {
        return $accessorResolver::isValidComponent($className)
            ? static::getComponentStubPath()
            : static::getClassStubPath();
    }

    protected static function getComponentStubPath()
    {
        return static::$stubsDir . 'facade_component.stub';
    }

    protected static function getClassStubPath()
    {
        return static::$stubsDir . 'facade_class.stub';
    }
}
