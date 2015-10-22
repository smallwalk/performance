<?php namespace App\Http\Controllers;

use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitController extends Controller {
	
	public function __construct() {
		$this->middleware('guest');
	}

	private	$host = '192.168.151.214';
    private	$port = 5672;
	private $user = 'guest';
	private $pass = 'guest';


	public function index() {
		/*
		$param = array(
			'current' => 'RabbitMQ',
			'tab' => 'rabbit',
		);
		return view('rabbit', $param);
		*/

		//$this->helloWord();
		//$this->workQueue();
		//$this->exchange();
		//$this->route();
		$this->topics();
		die;
	}

	private function topics() {
		$connection = new AMQPConnection($this->host, $this->port, $this->user, $this->pass);
		$channel = $connection->channel();

		$exchange = 'topic_logs';
		$type = 'topic';
		$passive = FALSE;
		$durable = FALSE;
		$auto_delete = FALSE;
		$channel->exchange_declare($exchange, $type, $passive, $durable, $auto_delete);

		$routing_key = empty($_GET['routing_key']) ? 'anonymous.info' : $_GET['routing_key'];
		$word = empty($_GET['msg'] ) ? "Hello World!s" : $_GET['msg'];

		$msg = new AMQPMessage($word);

		$channel->basic_publish($msg, $exchange, $routing_key);

		echo " [x] Sent ", $routing_key, ':', $word, "\n";

		$channel->close();
		$connection->close();
	}


	private function route() {
		$connection = new AMQPConnection($this->host, $this->port, $this->user, $this->pass);
		$channel = $connection->channel();

		$exchange = 'direct_logs';
		$type = 'direct';
		$passive = FALSE;
		$durable = FALSE;
		$auto_delete = FALSE;
		$channel->exchange_declare($exchange, $type, $passive, $durable, $auto_delete);

		$severity = empty($_GET['severity']) ? 'info' : $_GET['severity'];
		$word = empty($_GET['msg'] ) ? "Hello World!s" : $_GET['msg'];
		$msg = new AMQPMessage($word);

		$channel->basic_publish($msg, $exchange, $severity);
		echo " [x] Send " . $word . "\n";
		$channel->close();
		$connection->close();
	}

	private function exchange() {
		$connection = new AMQPConnection($this->host, $this->port, $this->user, $this->pass);
		$channel = $connection->channel();

		$exchange = 'logs';
		$type = 'fanout';
		$passive = FALSE;
		$durable = FALSE;
		$auto_delete = FALSE;
		$channel->exchange_declare($exchange, $type, $passive, $durable, $auto_delete);

		$word = empty($_GET['msg'] ) ? "Hello World!s" : $_GET['msg'];
		$msg = new AMQPMessage($word);

		$channel->basic_publish($msg, $exchange);
		echo " [x] Send " . $word . "\n";
		$channel->close();
		$connection->close();
	}

	private function workQueue() {
		$connection = new AMQPConnection($this->host, $this->port, $this->user, $this->pass);
		$channel = $connection->channel();

		$queue = "task_new";
		$passive = FALSE;
		$durable = TRUE; //持久化
		$exclusive = FALSE;
		$auto_delete = FALSE;
		//声明一个队列
		$channel->queue_declare($queue, $passive, $durable, $exclusive, $auto_delete);

		$word = empty($_GET['msg'] ) ? "Hello World!s" : $_GET['msg'];
		$msg = new AMQPMessage($word, array('delivery_mode' => 2)); // make message persistent
		$exchange = '';
		$routing_key = $queue;
		$channel->basic_publish($msg, $exchange, $routing_key);

		echo " [x] Send " . $word . "\n";

		$channel->close();
		$connection->close();
	}

	private function helloWord() {
		//sender
		$host = 'localhost';
		$port = 5672;
		$user = 'guest';
		$pass = 'guest';
		$connection = new AMQPConnection($host, $port, $user, $pass);
		$channel = $connection->channel();

		$queue = "hellos";
		$passive = FALSE;
		$durable = FALSE;
		$exclusive = FALSE;
		$auto_delete = FALSE;
		//声明一个队列
		$channel->queue_declare($queue, $passive, $durable, $exclusive, $auto_delete);
		
		$word = empty($_GET['msg'] ) ? "Hello World!s" : $_GET['msg'];
		$msg = new AMQPMessage($word);
		$exchange = '';
		$routing_key = $queue;
		$channel->basic_publish($msg, $exchange, $routing_key);

		echo " [x] Send " . $word . "\n";

		$channel->close();
		$connection->close();
	}

}
