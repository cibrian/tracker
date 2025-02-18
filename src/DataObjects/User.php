<?php
namespace App\DataObjects;

class User
{
    private string $username;
    private string $password;
    private int $domainId;

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getDomainId(): int
    {
        return $this->domainId;
    }

    public function setDomainId($domainId): void
    {
        $this->domainId = $domainId;
    }

    public static function createFromArray(array $data)
    {
        return new self(
            username: $data['username'],
            password: $data['password'],
        );
    }
}