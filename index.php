<?php

// 定义常量
define('BASEDIR', __DIR__); 

// 引入自动加载类
include BASEDIR . '/Core/Loader.php';
spl_autoload_register('\\Core\\Loader::autoload');

// 具体目标
App\Action\Index::test();
Core\Test::test();