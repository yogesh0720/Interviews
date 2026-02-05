<?php

/*
    6️⃣ Adapter Pattern
    ❓ When to use
    Integrating third-party APIs
    Interface mismatch
    ✅ Real use case
    Old API vs New API integration
*/

interface Notification
{
    public function send(string $msg): void;
}

class OldSmsGateway
{
    public function sendSms(string $msg): void
    {
        echo "Sending SMS with OldSmsGateway: $msg\n";
    }
}

class SmsAdapter implements Notification
{
    public function __construct(
        private OldSmsGateway $gateway
    ) {}

    public function send(string $msg): void
    {
        $this->gateway->sendSms($msg);
    }
}

class NewSmsGateway implements Notification
{
    public function send(string $msg): void
    {
        echo "Sending SMS with NewSmsGateway: $msg\n";
    }
}

function send(Notification $notification): void
{
    $notification->send('Hello World');
}

// Usage
send(new SmsAdapter(new OldSmsGateway()));
send(new NewSmsGateway());
