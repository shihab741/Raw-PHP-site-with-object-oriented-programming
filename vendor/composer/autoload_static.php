<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7199473370f552b0c04711f6c7209de8
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7199473370f552b0c04711f6c7209de8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7199473370f552b0c04711f6c7209de8::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
