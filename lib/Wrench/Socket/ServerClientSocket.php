<?php

namespace Wrench\Socket;

use Wrench\Socket\Socket;

class ServerClientSocket extends Socket
{
	/**
	 * @var float time of last received data on this socket
	 */
	protected $lastReceivedTime = null;

    /**
     * Constructor
     *
     * A server client socket is accepted from a listening socket, so there's
     * no need to call ->connect() or whatnot.
     *
     * @param resource $accepted_socket
     * @param array $options
     */
    public function __construct($accepted_socket, array $options = array())
    {
        parent::__construct($options);

        $this->socket = $accepted_socket;
        $this->lastReceivedTime = microtime(true);
        $this->connected = (boolean)$accepted_socket;
    }

    /**
     * Receive data from the socket
     *
     * @param int $length
     * @return string
     */
    public function receive($length = self::DEFAULT_RECEIVE_LENGTH)
    {
    	$this->lastReceivedTime = microtime(true);
    	return parent::receive($length);
    }

    /**
     * Get the time when data was last received on the socket
     *
     * @return int
     */
    public function getLastReceivedTime()
    {
    	return $this->lastReceivedTime;
    }
}