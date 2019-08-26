<?php
/**
 * 自动加载器的实现
 */
namespace Core;

class Loader
{
    public static function autoload($class)
    {
        print_r($class);
        echo PHP_EOL;
        require BASEDIR . '/' . str_replace('\\', '/', $class) . '.php';

    }
}
