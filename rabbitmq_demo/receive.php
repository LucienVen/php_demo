<?php

require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;

// 连接
$connection = new AMQPStreamConnection('127.0.0.1', 5672, 'guest', 'guest');
$channel = $connection->channel();


$channel->queue_declare('hello1', false, false, false, false);


echo " [*] Waiting for messages. To exit press CTRL+C\n";


$callback = function($msg){
    echo ' [x] Received ', $msg->body, "\n";
};

$channel->basic_consume('hello1', '', false, true, false, false, $callback);

while (count($channel->callbacks)){
    $channel->wait();
}