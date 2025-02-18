<?php
namespace App\Repositories;

class VisitRepository extends BaseRepository
{
    protected string $table = 'visits';

    public function create(array $data): int
    {
        return $this->db->execute(
            "INSERT INTO {$this->table} (url, ip, user_agent, visit_date, domain_id) VALUES (?, ?, ?, ?, ?)",
             $data
            );
    }

    public function checkIpVisitExists($data): array|null
    {
        return $this->db->fetchOne(
                "SELECT * FROM {$this->table} WHERE domain_id = ? AND url = ? AND ip = ? AND visit_date = ? LIMIT 1",
                $data
            );
    }

    public function getUniqueVisitsPerPageByDate(string $date, int $domain_id): array|null
    {
        return $this->db->fetchAll(
            "SELECT count(*) as total, url FROM {$this->table} WHERE visit_date = ? AND domain_id = ? GROUP BY url ORDER BY total desc",
            [$date, $domain_id]
        );
    }
}
