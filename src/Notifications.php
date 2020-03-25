<?php

namespace CodersStudio\Notifications;
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
        $class = config('notifications.system_notification');
        Notification::send($user, new $class($message, $link));
    }
}
