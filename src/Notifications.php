<?php

namespace CodersStudio\Notifications;
use Notification;

class Notifications
{
    /**
     * Send message to notifications
     *
     * @param int $notifiableId
     * @param string $message
     * @param string $link
     * @return void
     */
    public function send(int $notifiableId, $message = "", $link = "/"):void
    {
        $model = config('notifications.model');
        $notifiableObject = new $model();
        $notifiable =  $notifiableObject->findOrFail($notifiableId);
        $class = config('notifications.system_notification');
        Notification::send($notifiable, new $class($message, $link));
    }

    /**
     * Count unread messages notifications
     *
     * @param int $notifiable
     * @return integer
     */
    public function count(int $notifiableId, $message = "", $link = "/"):int
    {
        $model = config('notifications.model');
        $notifiableObject = new $model();
        $notifiable =  $notifiableObject->findOrFail($notifiableId);
        $class = config('notifications.system_notification');
        return $notifiable->unreadNotifications()->where('type', $class)->count();
    }
}
