<?php

namespace App\Actions;

use App\Repositories\VisitRepository;

class RetrieveVisitsByDate 
{
    private VisitRepository $visitRepository;

    public function __construct(
        VisitRepository $visitRepository
    ) 
    {
        $this->visitRepository = $visitRepository;
    }

    public function execute(string $date, int $domain_id)
    {
        return $this->visitRepository->getUniqueVisitsPerPageByDate($date, $domain_id);
    }

}