<?php

namespace CodersStudio\Notifications;
use Notification;
use Illuminate\Support\Collection;

class Notifications
{
    /**
     * Send message to notifications
     *
     * @param Illuminate\Support\Collection $notifiable
     * @param string $message
     * @param string $link
     * @return void
     */
    public function send(Collection $notifiable, $message = "", $link = "/"):void
    {
        $class = config('notifications.system_notification');
        Notification::send($notifiable, new $class($message, $link));
    }
    
    /**
     * Count unread messages notifications
     *
     * @param Illuminate\Support\Collection $notifiable
     * @return integer
     */
    public function count(Collection $notifiable, $message = "", $link = "/"):integer
    {
        $class = config('notifications.system_notification');
        return $notifiable->unreadNotifications()->where('type', $class)->count();
    }
    
   
}
