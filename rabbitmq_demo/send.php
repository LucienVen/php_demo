<?php

require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;


// 连接
$connection = new AMQPStreamConnection('127.0.0.1', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('hello1', false, false,false,false);

$msg = new AMQPMessage('Hello, RabbitMQ233333333');

$channel->basic_publish($msg, '', 'hello1');

echo " [x] Sent 'Hello RabbitMQ!'\n";

$channel->close();
$connection->close();
