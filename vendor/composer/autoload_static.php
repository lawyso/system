<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7477491d98b92df76e71d2f97f526439
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

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7477491d98b92df76e71d2f97f526439::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7477491d98b92df76e71d2f97f526439::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
