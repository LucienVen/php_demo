<?php

require_once __DIR__ . "/../vendor/autoload.php";

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;


// 连接
$connection = new AMQPStreamConnection('127.0.0.1', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('hello1', false, false, false, false);

echo " [*] Waiting for messages. To exit press CTRL+C\n";

$callback = function ($msg) {
    echo " [x] Received ", $msg->body, "\n"; //根据"."数量个数获取延迟时间，单位秒
    sleep(substr_count($msg->body, '.')); //模拟业务执行时间延迟
    echo " [x] Done", "\n";
    $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);

};

$channel->basic_consume('part2', '', false, false, false, false, $callback);

while (count($channel->callbacks)) {
    $channel->wait();
}
