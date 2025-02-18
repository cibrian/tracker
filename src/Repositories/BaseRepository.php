<?php
namespace App\Repositories;

use App\Handlers\DBHandler;

abstract class BaseRepository
{
    protected DBHandler $db;
    protected string $table;

    public function __construct(DBHandler $db)
    {
        $this->db = $db;
    }

    public function getAll(): array
    {
        return $this->db->fetchAll("SELECT * FROM {$this->table}");
    }
    
    public function getById(int $id): array|null
    {
        return $this->db->fetchOne("SELECT * FROM {$this->table} WHERE id = ?", [$id]);
    }
}
