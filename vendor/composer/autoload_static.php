<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd82378f5e4ecd55d49b5d131f7255763
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'TinyPixel\\AdminToConsole\\' => 25,
        ),
        'C' => 
        array (
            'Composer\\Installers\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'TinyPixel\\AdminToConsole\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Composer\\Installers\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/installers/src/Composer/Installers',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd82378f5e4ecd55d49b5d131f7255763::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd82378f5e4ecd55d49b5d131f7255763::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
