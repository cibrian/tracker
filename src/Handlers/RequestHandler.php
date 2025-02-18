<?php
namespace App\Handlers;

class RequestHandler
{
    private array $server;

    public function __construct()
    {
        $this->server = $_SERVER;
    }

    public function getRequestMethod(): string
    {
        return $this->server['REQUEST_METHOD'] ?? 'GET';
    }

    public function getClientIp(): string
    {
        return $this->server['REMOTE_ADDR'] ?? '0.0.0.0';
    }

    public function getUserAgent(): string
    {
        return $this->server['HTTP_USER_AGENT'] ?? 'N/A';
    }

    public function getOriginPage(): string
    {
        return $this->server['HTTP_TRACKER_SOURCE_PAGE'] ?? 'N/A';
    }

    public function getBody() : array 
    {
        return json_decode(file_get_contents("php://input") ?? '', true);
    }

    public function post() : array 
    {
        return $_POST;
    }

    public function get() : array 
    {
        return $_GET;
    }

}