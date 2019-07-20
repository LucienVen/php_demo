<?php

require_once __DIR__ . "/../vendor/autoload.php";

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class FibonacciRpcClient
{
    private $connection;
    private $channel;
    private $callback_queue;
    private $response;
    private $corr_id;

    public function __construct()
    {
        $this->connection = new AMQPStreamConnection(
            '127.0.0.1', 5672, 'guest', 'guest'
        );

        $this->channel = $this->connection->channel();
        list($this->callback_queue, ,) = $this->channel->queue_declare("", false, false, true, false);

        $this->channel->basic_consume($this->callback_queue, false, true, false, false,
                                                array($this, 'onResponse'));
    }

    public function onResponse($req)
    {
        if ($req->get('correlation_id') == $this->corr_id) {
            $this->response = $req->body;
        }
    }

    public function call($n)
    {
        $this->response = null;
        $this->corr_id = uniqid();

        $msg = new AMQPMessage(
            (string)$n,
            array(
                'correlation_id' => $this->corr_id,
                'reply_to' => $this->callback_queue
            )
        );

        $this->channel->basic_publish($msg, '', 'rpc_queue');

        while (!$this->response) {
            $this->channel->wait();
        }

        return intval($this->response);
    }
}

$fibonacci_rpc = new FibonacciRpcClient();
$response = $fibonacci_rpc->call(30);

echo ' [.] Got ', $response, "\n";
