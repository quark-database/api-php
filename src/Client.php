<?php

namespace Anafro\QuarkApi;

class Client
{
    private string $token;
    private string $host;
    private int $port;
    private TcpClient $tcp;

    public function __construct(string $token, string $host = "localhost", int $port = 10000)
    {
        $this->token = $token;
        $this->host = $host;
        $this->port = $port;
        $this->tcp = new TcpClient($this->host, $this->port);
    }

    /**
     * @throws InstructionResultFormatException
     * @throws TcpException
     */
    function query(string $query): QueryResult
    {
        $request = json_encode([
            "token" => $this->token,
            "query" => $query,
        ]);

        return new QueryResult($this->tcp->sendMessage($request));
    }
}