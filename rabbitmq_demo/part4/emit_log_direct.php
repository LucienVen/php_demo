<?php

require_once __DIR__ . "/../vendor/autoload.php";

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

// 连接
$connection = new AMQPStreamConnection('127.0.0.1', 5672, 'guest', 'guest');
$channel = $connection->channel();

// 创建交换机，设置为direct模式
$channel->exchange_declare('direct_logs', 'direct', false, false, false);

// demo从命令行中获取日志信息，并设置默认日志级别
$severity = (isset($argv[1]) && !empty($argv[1])) ? $argv[1] : 'info';

// 获取日志文本信息
$data = implode(' ', array_slice($argv, 2));
if (empty($data)) {
    $data = "hello, exchange routing!";
}

$msg = new AMQPMessage($data);

// 绑定额外路由参数 $severity (或称作绑定类型)
$channel->basic_publish($msg, 'direct_logs', $severity);

echo " [x] Sent ", $severity, ':', $data, " \n";

$channel->close();
$connection->close();
