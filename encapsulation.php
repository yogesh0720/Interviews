<?php

class User
{
    private string $username; // strict typing for better safety

    public function getUserName(): string
    {
        return $this->username;
    }

    public function setUserName(string $username): void
    {
        $this->username = $username;
    }
}

$user = new User();
$user->setUserName('Yogesh');

var_dump($user->getUserName());
