<?php

namespace Anafro\QuarkApi;

use Socket;

class TcpClient
{
    private string $host;
    private int $port;

    public function __construct(string $host, int $port)
    {
        $this->host = $host;
        $this->port = $port;
    }

    /**
     * @throws TcpException
     */
    public function sendMessage(string $message): string
    {
        ob_implicit_flush();

        if(($socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false) {
            throw new TcpException("Creation of socket has failed, because: " . $this->getSocketError());
        }

        if(socket_connect($socket, $this->host, $this->port) === false) {
            throw new TcpException("Socket binding has failed, because: ". $this->getSocketError($socket));
        }

        $messageHeader = array_reverse(unpack("C*", pack("L", strlen($message))));
        $messageBody = unpack("C*", $message);

        $messageBytes = array_merge($messageHeader, $messageBody);

        socket_write($socket, call_user_func_array("pack", array_merge(array("C*"), $messageBytes)), count($messageBytes));

        if(($responseHeader = socket_read($socket, 4)) === false) {
            throw new TcpException("Reading the header from socket has failed, because: " . $this->getSocketError($socket));
        }

        $responseBodyLength = ord($responseHeader[3]) + (ord($responseHeader[2]) << 8) + (ord($responseHeader[1]) << 16) + (ord($responseHeader[0]) << 24);

        if(($responseBody = socket_read($socket, $responseBodyLength, PHP_NORMAL_READ)) === false) {
            throw new TcpException("Reading the header from socket has failed, because: " . $this->getSocketError($socket));
        }

        socket_close($socket);

        return $responseBody;
    }

    private function getSocketError(?Socket $socket = null): string
    {
        return socket_strerror(socket_last_error(socket: $socket));
    }
}