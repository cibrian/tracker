<?php
namespace App\Repositories;

class UserRepository extends BaseRepository
{
    protected string $table = 'users';

    public function getByUsername(string $username): array|null
    {
        return $this->db->fetchOne("SELECT * FROM {$this->table} WHERE username = ?", [$username]);
    }
}
