<?php

namespace App;

class User
{
    protected $mailer;

    protected $mailerCallable;

    public $firstName;

    public $lastName;

    public $email;

    public function __construct(string $email = '')
    {
        $this->email = $email;
    }

    public function getFullName()
    {
        return trim("{$this->firstName} {$this->lastName}");
    }

    public function setMailer(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function setMailerCallable(callable $mailerCallable)
    {
        $this->mailerCallable = $mailerCallable;
    }

    public function notify($message)
    {
        return $this->mailer->sendMessage($this->email, $message);
    }

    public function sendNotify($message)
    {
        return call_user_func($this->mailerCallable, $this->email, $message);
    }

    public function sendNotifyMockery($message)
    {
        return Mailer::send($this->email, $message);
    }
}
