<?php
require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Exchange\AMQPExchangeType;

$exchange = 'rabbit_exchange';
$queue = 'default';
$consumerTag = 'consumer';

$host = 'fish-01.rmq.cloudamqp.com';
$port = '5672';
$user = 'pwlywyon';
$pass = 'xPaQUIZZBWolIYr41zmIs6DbzvQ8XhI4';
$vhost = 'pwlywyon';

$connection = new AMQPStreamConnection($host, $port, $user, $pass, $vhost);
$channel = $connection->channel();

$channel->queue_declare($queue, false, true, false, false);

$channel->exchange_declare($exchange, AMQPExchangeType::DIRECT, false, true, false);
$channel->queue_bind($queue, $exchange);

function process_message($message)
{
    echo "<pre>";
    $msg = json_decode($message->body, true);
    print_r($msg);
    echo "</pre>";
    $message->delivery_info['channel']->basic_ack($message->delivery->info['delivery_tag']);

    if($message->body === 'quit'){
        $message->delivery_info['channel']->basic_cancel($message->delivery_info['consumer_tag']);
    }
}


$channel->basic_consume($queue, $consumerTag, false, false, false, false, 'process_message');

function shutdown($channel, $connection) 
{
    $channel->close();
    $connection->close();
}

register_shutdown_function('shutdown', $channel, $connection);
while ($channel ->is_consuming()) {
    $channel->wait();
}
