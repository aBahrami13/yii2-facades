<?php

namespace abahrami13\facades;

use Yii;
use yii\helpers\FileHelper;

class FacadeFileHandler
{
    public function ensureFacadeExists(
        $className,
        $stubManagerClass = FacadeStubManager::class,
        $accessorClass = FacadeAccessorResolver::class
    ) {
        static::prepareDirectory();
        $path = static::getFacadePath($className);

        if (file_exists($path)) {
            return $path;
        }

        $accessorClass::ensureClassIsValid($className);

        $stubPath = $stubManagerClass::getStubPath($className);

        return $this->createFacadeFile($className, $stubPath);
    }

    protected static function getFacadePath($className)
    {
        return static::getFacadeDir()
            . '/facade-' . sha1($className) . '.php';
    }

    protected static function prepareDirectory()
    {
        FileHelper::createDirectory(static::getFacadeDir());
    }

    protected static function createFacadeFile(
        $className,
        $stubPath
    ) {
        $path = static::getFacadePath($className);
        file_put_contents(
            $path,
            static::formatFacadeStub(
                $className,
                file_get_contents($stubPath)
            )
        );
        return $path;
    }

    protected static function formatFacadeStub(
        $className,
        $stub,
        $accessorClass = FacadeAccessorResolver::class
    ) {
        $replacements = [
            str_replace('/', '\\', dirname(str_replace('\\', '/', $className))),
            substr($className, strrpos($className, '\\') + 1),
            $accessorClass::getAccessor($className),
        ];

        return str_replace(
            ['{{DummyNamespace}}', '{{DummyClass}}', '{{DummyAccessor}}'],
            $replacements,
            $stub
        );
    }

    protected static function getFacadeDir()
    {
        return Yii::getAlias('@runtime/facades');
    }
}
