<?php
namespace App\ValueObjects;

class Url
{
    private string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function getDomain(): string
    {
        $parsedUrl = parse_url($this->url);
        return $parsedUrl['host'] . (isset($parsedUrl['port']) ? ":" . $parsedUrl['port'] : "");
    }

    public function getPage(): string
    {
        $parsedUrl = parse_url($this->url);
        return $parsedUrl['path'];
    }
}