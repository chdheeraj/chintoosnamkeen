<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit34fb2a41a26c8a3d8b7d970232a1c9cf
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit34fb2a41a26c8a3d8b7d970232a1c9cf::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit34fb2a41a26c8a3d8b7d970232a1c9cf::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit34fb2a41a26c8a3d8b7d970232a1c9cf::$classMap;

        }, null, ClassLoader::class);
    }
}
