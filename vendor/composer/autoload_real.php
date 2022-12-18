<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit9f89413184915bf4c19d6ceba6d90fbc
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInit9f89413184915bf4c19d6ceba6d90fbc', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit9f89413184915bf4c19d6ceba6d90fbc', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit9f89413184915bf4c19d6ceba6d90fbc::getInitializer($loader));

        $loader->register(true);

        $includeFiles = \Composer\Autoload\ComposerStaticInit9f89413184915bf4c19d6ceba6d90fbc::$files;
        foreach ($includeFiles as $fileIdentifier => $file) {
            composerRequire9f89413184915bf4c19d6ceba6d90fbc($fileIdentifier, $file);
        }

        return $loader;
    }
}

/**
 * @param string $fileIdentifier
 * @param string $file
 * @return void
 */
function composerRequire9f89413184915bf4c19d6ceba6d90fbc($fileIdentifier, $file)
{
    if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])) {
        $GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;

        require $file;
    }
}