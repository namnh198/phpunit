<?php

namespace App;

class Mailer
{
    public function sendMessage($email, $message)
    {
        if(empty($email)) throw new \Exception("Email is required");

        sleep(3);

        echo "`{$message}` sent to `{$email}` successfully.";

        return true;
    }

    public static function send($email, $message)
    {
        if(empty($email)) {
            throw new \InvalidArgumentException;
        }

        echo "`{$message}` sent to `{$email}` successfully.";

        return true;
    }
}
