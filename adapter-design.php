<?php

class Target
{
    public function __construct()
    {
        echo "Target class is initiated";
    }

    public function request()
    {
        echo "Handling request";
    }
}


class Adaptee
{
    public function specificRequest()
    {
        echo "Specific request";
    }
}

/**
 * The Adapter makes the Adaptee's interface compatible with the Target's
 * interface.
 */
class Adapter extends Target
{
    private $adaptee;

    public function __construct(Adaptee $adaptee)
    {
        $this->adaptee = $adaptee;
    }

    public function request()
    {
        $this->adaptee->specificRequest();
    }
}
