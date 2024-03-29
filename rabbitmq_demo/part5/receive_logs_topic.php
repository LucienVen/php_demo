<?php

require_once __DIR__ . "/../vendor/autoload.php";

use PhpAmqpLib\Connection\AMQPStreamConnection;

// 连接
$connection = new AMQPStreamConnection('127.0.0.1', 5672, 'guest', 'guest');
$channel = $connection->channel();

// 创建交换机，类型为topic
$channel->exchange_declare('topic_logs', 'topic', false, false, false);


list($queue_name, ,) = $channel->queue_declare("", false, false, true, false);


print_r($channel->queue_declare("", false, false, true, false));
echo "\n";
echo ' [*] queue_name: ', $queue_name, "\n";


// 获取绑定路由的值/数组
$binding_keys = array_slice($argv, 1);


if (empty($binding_keys)) {
    file_put_contents('php://stderr', "Usage: $argv[0] [binding_key]\n");
    exit(1);
}

foreach ($binding_keys as $binding_key) {
    $channel->queue_bind($queue_name, 'topic_logs', $binding_key);
}

echo ' [*] Waiting for logs. To exit press CTRL+C', "\n";

$callback = function($msg){
    echo ' [x] ', $msg->delivery_info['routing_key'], ':', $msg->body, "\n";
};

$channel->basic_consume($queue_name, '', false, true, false, false, $callback);

while (count($channel->callbacks)) {
    $channel->wait();
}

$channel->close();
$connection->close();