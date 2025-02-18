<?php

require 'vendor/autoload.php';

use App\DataObjects\User;
use App\Actions\LoginUser;
use App\Handlers\DBHandler;
use App\Handlers\RequestHandler;
use App\Repositories\UserRepository;

session_start();
$requestHandler = new RequestHandler();
$user = User::createFromArray($requestHandler->post());
$db = new DBHandler();

(new LoginUser(new UserRepository($db)))->execute($user);

?>
