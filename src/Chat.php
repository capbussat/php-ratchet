<?php

namespace MyChatApp;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

require dirname(__DIR__) . '/vendor/autoload.php';

class Chat implements MessageComponentInterface
{
	protected $clients;
	private $subscriptions;
	private $users;
	public function __construct()
	{
		$this->clients = new \SplObjectStorage;
		$this->subscriptions = [];
		$this->users = [];
	}

	public function onOpen(ConnectionInterface $conn)
	{
		// Store the new connection to send messages to later
		$this->clients->attach($conn);
		echo "New connection! ({$conn->resourceId})\n";
		$conn->send("{$conn->resourceId} you have joined the chat");
	}

	public function onMessage(ConnectionInterface $from, $msg)
	{
		
		$numRecv = count($this->clients) - 1;
		echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n", $from->resourceId, $msg, $numRecv, $numRecv ==  1 ? '' : 's');
		foreach ($this->clients as $client) {
			if ($from !== $client) {
				//The sender is not the receiver, send to other clients
				$client->send($msg);
				// $client->send( "There are {$numRecv} other connections");
			}
		}
	}

	public function onClose(ConnectionInterface $conn)
	{
		// The connection is closed, remove from connection list
		$this->clients->detach($conn);
		echo "Connection {$conn->resourceId} has disconnected\n";
	}

	public function onError(ConnectionInterface $conn, \Exception $e)
	{
		echo "An error has occurred: {$e->getMessage()}\n";
		$conn->close();
	}

	public function log( $something)
	{
		// begin log	
		ob_flush();
		ob_start();
		var_dump($something);
		file_put_contents("dump.txt", ob_get_flush(), FILE_APPEND);
		// end log	
	}
}
