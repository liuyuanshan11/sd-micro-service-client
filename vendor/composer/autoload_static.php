<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0764fc34d70a4b364fa2df188f574077
{
    public static $prefixLengthsPsr4 = array (
        'l' => 
        array (
            'liuyuanshan11\\SdMicroServiceClient\\' => 35,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'liuyuanshan11\\SdMicroServiceClient\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'liuyuanshan11\\SdMicroServiceClient\\MicroService' => __DIR__ . '/../..' . '/src/MicroService.php',
        'liuyuanshan11\\SdMicroServiceClient\\constants\\ResponseCode' => __DIR__ . '/../..' . '/src/constants/ResponseCode.php',
        'liuyuanshan11\\SdMicroServiceClient\\container\\Register' => __DIR__ . '/../..' . '/src/container/Register.php',
        'liuyuanshan11\\SdMicroServiceClient\\http\\HttpClient' => __DIR__ . '/../..' . '/src/http/HttpClient.php',
        'liuyuanshan11\\SdMicroServiceClient\\services\\HttpMicroServiceClient' => __DIR__ . '/../..' . '/src/services/HttpMicroServiceClient.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0764fc34d70a4b364fa2df188f574077::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0764fc34d70a4b364fa2df188f574077::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit0764fc34d70a4b364fa2df188f574077::$classMap;

        }, null, ClassLoader::class);
    }
}
