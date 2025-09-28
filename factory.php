<?php
interface Factory
{
    public function create();
}

class Friend
{
    public function sayHello()
    {
        return "Hello, I am your friend!";
    }
}

class FriendFactory implements Factory
{
    public function create(): Friend
    {
        return new Friend();
    }
}

$factory = new FriendFactory();
$friend = $factory->create();

echo $friend->sayHello(); //Hello, I am your friend!
