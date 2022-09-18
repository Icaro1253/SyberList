<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitf522e07fae9b6d56da3ac9f5f5694777
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

        spl_autoload_register(array('ComposerAutoloaderInitf522e07fae9b6d56da3ac9f5f5694777', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitf522e07fae9b6d56da3ac9f5f5694777', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        \Composer\Autoload\ComposerStaticInitf522e07fae9b6d56da3ac9f5f5694777::getInitializer($loader)();

        $loader->register(true);

        return $loader;
    }
}
