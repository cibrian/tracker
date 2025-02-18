<?php
namespace App\DataObjects;

class Domain
{
    private int $id;
    private string $domain;

    public function __construct(int $id, string $domain)
    {
        $this->id = $id;
        $this->domain = $domain;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    public static function createFromArray(array $data)
    {
        return new self(
            id: $data['id'],
            domain: $data['domain'],
        );
    }
}