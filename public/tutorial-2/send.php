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
$queueName = 'gc_test_5';
//当队列不存在时是否会抛出一个错误信息，仍然不会被声明
$passive = FALSE;
//是否持久化(false:服务重启队列丢失)
$durable = TRUE;
//仅服务于一个客户端
$exclusive = FALSE;
//退出后队列不丢失,If set, the queue is deleted when all consumers have finished using it
$autoDelete = FALSE;
//创建队列
$channel->queue_declare($queueName, $passive, $durable, $exclusive, $autoDelete);

$timeStart = microtime(TRUE);
for ($i = 0; $i < 10; $i++) {
	//消息 delivery_mode＝2，服务重启后消息不丢失
	$word = "123456789" . str_repeat('.', $i);
	$msg = new AMQPMessage($word, array('delivery_mode' => 2));
	//发送
	$routeKey = $queueName;
	$exchange = '';
	$channel->basic_publish($msg, $exchange, $routeKey);

	echo " [ Sent $word ]\n";
}
$timeEnd = microtime(TRUE);

$timeSpend = $timeEnd - $timeStart;

echo "Time Spend:" . $timeSpend . "\n";

$channel->close();
$connection->close();
