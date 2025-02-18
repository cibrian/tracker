<?php

namespace App\Actions;

use App\DataObjects\Domain;
use Exception;
use App\DataObjects\Visit;
use App\Repositories\VisitRepository;
use App\Repositories\DomainRepository;

class CreateVisit 
{
    private DomainRepository $domainRepository;
    private VisitRepository $visitRepository;

    public function __construct(
        DomainRepository $domainRepository,
        VisitRepository $visitRepository
    ) 
    {
        $this->visitRepository = $visitRepository;
        $this->domainRepository = $domainRepository;
    }

    public function execute(Visit $visit)
    {
        if (!$domainData = $this->domainRepository->getByDomain($visit->getUrl()->getDomain()))
        {
            throw new Exception("Domain not Found: {$visit->getUrl()->getDomain()}");
        }

        $domain = Domain::createFromArray($domainData);

        if ($this->visitRepository->checkIpVisitExists(
            [
                $domain->getId(),
                $visit->getUrl()->getPage(),
                $visit->getIp(),
                $visit->getDate()
            ]
        ))
        {
            throw new Exception("Visit already registered");
        }

        $result = $this->visitRepository->create(
            [
                $visit->getUrl()->getPage(),
                $visit->getIp(),
                $visit->getUserAgent(),
                $visit->getDate(),
                $domain->getId(),
            ]
        );

        if(!$result)
        {
            throw new Exception("Visit not stored");
        }

        return $result;
    }

}