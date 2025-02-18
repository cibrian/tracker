<?php
namespace App\DataObjects;

use App\ValueObjects\Url;
use App\Handlers\RequestHandler;

class Visit
{
    private string $ip;
    private string $userAgent;
    private string $date;
    private Url $url;

    public function __construct(string $ip, string $userAgent, Url $url, string $date)
    {
        $this->ip = $ip;
        $this->userAgent = $userAgent;
        $this->url = $url;
        $this->date = $date;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    public function getUrl(): Url
    {
        return $this->url;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public static function createFromRequest(RequestHandler $serverHandler){
        return new self(
            ip: $serverHandler->getClientIp(),
            userAgent: $serverHandler->getUserAgent(),
            url: new Url($serverHandler->getBody()['url']),
            date: date('Y-m-d')
        );
    }
}