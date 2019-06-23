<?php
/**
 * 自动加载器的实现
 */
namespace Core;

class Loader
{
    static function autoload($class)
    {
        require BASEDIR.'/'.str_replace('\\', '/', $class) . '.php';
        
    }
}