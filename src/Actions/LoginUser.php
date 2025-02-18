<?php

namespace App\Actions;

use App\DataObjects\User;
use App\Repositories\UserRepository;

class LoginUser 
{
    private UserRepository $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) 
    {
        $this->userRepository = $userRepository;
    }

    public function execute(User $user)
    {
        if (!$userData = $this->userRepository->getByUsername($user->getUsername()))
        {
            header("Location: index.php?error=Invalid Credentials");
            exit();
        }

        if (!password_verify($user->getPassword(), $userData['password'])) 
        {
            header("Location: index.php?error=Invalid Credentials");
            exit();
        }

        $user->setDomainId($userData['domain_id']);
        
        $_SESSION['user'] = $user;
        header("Location: dashboard.php");
        exit();
    }
}