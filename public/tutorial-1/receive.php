<?php
require __DIR__.'/../bootstrap/autoload.php';

use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

//rabbitmq服务器
$host = '192.168.151.214';
//rabbitmq端口
$port = 5672;
$user = 'guest';
$pass = 'guest';

//创建连接
$connection = new AMQPConnection($host, $port, $user, $pass);
//获取通道
$channel = $connection->channel();

//队列名称
$queueName = 'gc_test_1';
//当队列不存在时是否会抛出一个错误信息，仍然不会被声明
$passive = FALSE;
//是否持久化(false:服务重启时队列消息)
$durable = TRUE;
//
$exclusive = FALSE;
//退出后队列不丢失.If set, the queue is deleted when all consumers have finished using it
$autoDelete = FALSE;
//创建队列
$channel->queue_declare($queueName, $passive, $durable, $exclusive, $autoDelete);

$callBack = function($msg) {
	echo "[x] Received ", $msg->body, "\n";
};

$consumerTag = '';
$noLocal = FALSE;
$noACK = TRUE;
$exclusive = FALSE;
$noWait = FALSE;
$channel->basic_consume($queueName, $consumerTag, $noLocal, $noACK, $exclusive, $noWait, $callBack);

while(count($channel->callbacks)) {
	$channel->wait();
}

$channel->close();
$connection->close();
