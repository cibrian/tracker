<?php

require 'vendor/autoload.php';

use App\Handlers\DBHandler;
use App\Handlers\RequestHandler;
use App\Actions\RetrieveVisitsByDate;
use App\Repositories\VisitRepository;

session_start();

$requestHandler = new RequestHandler();
$db = new DBHandler();

$action = new RetrieveVisitsByDate(
    new VisitRepository($db)
);

$date = $requestHandler->get()['date'];
$user = $_SESSION['user'];

$results = $action->execute($date, $user->getDomainId());

echo json_encode(
        $results
);

?>