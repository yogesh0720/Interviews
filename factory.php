<?php
interface Factory
{
    public function create();
}

class Friend implements Factory
{
    public function create()
    {
        $friend = new Friend();
    }
}

$friend = new Friend();
$friend->create();
