<?php

require 'vendor/autoload.php';

use App\DataObjects\Visit;
use App\Handlers\DBHandler;
use App\Actions\CreateVisit;
use App\Handlers\RequestHandler;
use App\Repositories\VisitRepository;
use App\Repositories\DomainRepository;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

$requestHandler = new RequestHandler();
$newVisit = Visit::createFromRequest($requestHandler);
$db = new DBHandler();

$action = new CreateVisit(
    new DomainRepository($db),
    new VisitRepository($db),
);

try {
    $result = $action->execute($newVisit);
    echo json_encode([
        "result" => "Visit created"
    ]
);
} catch (Exception $e) {
    echo json_encode([
        "error" => $e->getMessage()
    ]
);
}


?>