<?php

require_once __DIR__ . "/../vendor/autoload.php";

use PhpAmqpLib\Connection\AMQPStreamConnection;
// 连接
$connection = new AMQPStreamConnection('127.0.0.1', 5672, 'guest', 'guest');
$channel = $connection->channel();


// 声明转换
$channel->exchange_declare('logs', 'fanout', false, false, false);

# 临时队列
list($queue_name, ,) = $channel->queue_declare("", false, false, true, false);

# 交换与队列之间的 绑定
$channel->queue_bind($queue_name, 'logs');

echo ' [*] Waiting for logs. To exit press CTRL+C', "\n";

$callback = function($msg){
    echo ' [x] ', $msg->body, "\n";
};

$channel->basic_consume($queue_name, '', false, true, false, false, $callback);

while(count($channel->callbacks)){
    $channel->wait();
}

$channel->close();
$connection->close();