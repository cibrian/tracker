<?php
namespace App\Repositories;

class DomainRepository extends BaseRepository
{
    protected string $table = 'domains';

    public function getByDomain(string $domain): array|null
    {
        return $this->db->fetchOne("SELECT * FROM {$this->table} WHERE domain = ?", [$domain]);
    }
}
