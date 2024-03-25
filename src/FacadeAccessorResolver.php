<?php

namespace abahrami13\facades;

use Yii;
use yii\base\InvalidCallException;

class FacadeAccessorResolver
{
    public static function ensureClassIsValid($className)
    {
        if (
            static::isValidComponent($className)
            || class_exists(static::removeFacadeNamespace($className))
        ) {
            return true;
        }

        throw new InvalidCallException(
            'Invalid Component or Class: The `'
                . static::getAccessor($className) . '`'
                . ' is not registered as a component or does not exists!'
        );
    }

    public static function getAccessor($className)
    {
        return static::isValidComponent($className)
            ? static::getComponentId($className)
            : static::removeFacadeNamespace($className);
    }

    public static function isValidComponent($className)
    {
        return Yii::$app->get(static::getComponentId($className), false) !== null;
    }

    protected static function getComponentId($className)
    {
        return lcfirst(static::removeFacadeNamespace($className));
    }

    protected static function removeFacadeNamespace(
        $className,
        $autoLoaderClass = RegisterFacadeAutoloader::class
    ) {
        return substr($className, strlen($autoLoaderClass::getFacadeNamespace()));
    }
}
