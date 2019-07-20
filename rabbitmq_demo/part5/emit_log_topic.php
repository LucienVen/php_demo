<?php

require_once __DIR__ . "/../vendor/autoload.php";

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

// 连接
$connection = new AMQPStreamConnection('127.0.0.1', 5672, 'guest', 'guest');
$channel = $connection->channel();

// 创建交换机，类型为topic
$channel->exchange_declare('topic_logs', 'topic', false, false, false);

// 获取路由键值
$routing_key = isset($argv[1]) && !empty($argv[1]) ? $argv[1] : 'anonymous.info';

// 获取传输信息
$data = implode(' ', array_slice($argv, 2));
if(empty($data)){
    $data = 'Hello, rabbitmq exchange topic';
}

$msg = new AMQPMessage($data);

$channel->basic_publish($msg, 'topic_logs', $routing_key);

echo " [x] Sent ",$routing_key,':',$data," \n";

$channel->close();
$connection->close();