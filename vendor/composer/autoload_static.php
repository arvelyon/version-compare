<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2cf4e25d99c9f226dc077eebbd31f900
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Arvelyon\\VersionCompare\\Test\\' => 29,
            'Arvelyon\\VersionCompare\\' => 24,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Arvelyon\\VersionCompare\\Test\\' => 
        array (
            0 => __DIR__ . '/../..' . '/test/Arvelyon/VersionCompare',
        ),
        'Arvelyon\\VersionCompare\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Arvelyon/VersionCompare',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2cf4e25d99c9f226dc077eebbd31f900::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2cf4e25d99c9f226dc077eebbd31f900::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}