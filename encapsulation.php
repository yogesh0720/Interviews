<?php
//hiding the information with wrapping some data.
// getter and setter example is Encapsulation

class User
{
    private $username;

    function getUserName()
    {
        return $this->username;
    }

    function setUserName($username)
    {
        $this->username = $username;
    }
}
$username = new User();
$username->setUserName('Yogesh');

var_dump($username->getUserName());
