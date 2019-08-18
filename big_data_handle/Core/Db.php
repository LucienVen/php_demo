<?php
/**
 * 数据库连接类
 */
namespace Core;

use PDO;

class Db
{
    private static $_instance = null;
    private $_db = null;

    private function __construct($config = [])
    {
        $dsn = sprintf('mysql:host=%s;dbname=%s', $config['db_host'], $config['db_name']);
        $this->_db = new PDO($dsn, $config['db_user'], $config['db_pass']);
    }

    public static function getInstance($config = [])
    {
        if (self::$_instance === null) {
            self::$_instance = new self($config);
        }
        return self::$_instance;
    }

    // 获取数据库句柄
    public function db()
    {
        return $this->_db;
    }

    private function __clone(){}
}
