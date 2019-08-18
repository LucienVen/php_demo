<?php


define("FILE_PATH", __DIR__ . "/File");
define("CORE_PATH", __DIR__ . DIRECTORY_SEPARATOR . "Core");
define("BASE_PATH", __DIR__);

// print_r(CORE_PATH . '/Autoload.php');exit;

use Core\Db;

require 'vendor/autoload.php';
require CORE_PATH . "/Autoload.php";


spl_autoload_register('\\Core\\Autoload::load');


// 数据库配置
$db_config = [
    'db_name' => 'test',
    'db_host' => '127.0.0.1',
    'db_sort' => '3306',
    'db_user' => 'root',
    'db_pass' => '123456',
];

$db = Db::getInstance($db_config)->db();

$sth = $db->query('select * from city');
$res = $sth->fetchAll(PDO::FETCH_ASSOC);
print_r($res);