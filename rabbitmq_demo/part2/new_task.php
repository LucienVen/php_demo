<?php

require_once __DIR__ . "/../vendor/autoload.php";

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

// 连接
$connection = new AMQPStreamConnection('127.0.0.1', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('part2', false, false, false, false);

$data = implode(' ', array_slice($argv, 1));
if (empty($data)) {
    $data = "Hello, world!";
}

$msg = new AMQPMessage($data);

$channel->basic_publish($msg, '', 'part2');

echo " [x] Sent 'Hello RabbitMQ!'\n";

$channel->close();
$connection->close();
