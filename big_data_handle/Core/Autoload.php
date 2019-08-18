<?php
/**
 * 自动加载
 */

namespace Core;

class Autoload
{
    public static function load($class)
    {
        $file = BASE_PATH . DIRECTORY_SEPARATOR . str_replace('\\', '/', $class) . '.php';
        if (file_exists($file)) {
            require $file;
        } else {
            throw new \Exception('load: ' . $loadPath . ': file does not exist!', 404);
        }
    }
}
