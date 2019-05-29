<?php

namespace CodersStudio\Notifications;
use CodersStudio\Notifications\Notifications\System;
use Notification;

class Notifications
{
    /**
     * Send message to notifications
     *
     * @param integer $user
     * @param string $message
     * @param string $link
     * @return void
     */
    public function send($user, $message = "", $link = "/"):void
    {
        Notification::send($user, new System($message, $link));
    }
}