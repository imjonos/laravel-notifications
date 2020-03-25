<?php

namespace CodersStudio\Notifications\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;


class System extends Notification
{
    use Queueable;

    protected $text; 
    protected $link;
    protected $params;
    

    /**
     * Create a new notification instance.
     * text string текст уведомления
     * link string ссылка для открытия при клике
     * params Array дополнительные параметры
     * @return void
     */
    public function __construct($text = "", $link = "", $params = [])
    {
        $this->text = $text;
        $this->link = $link;
        $this->params = $params;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

   
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray ($notifiable)
    {
        return [
            "text" => $this->text,
            "link" => $this->link,
            "params" => $this->params,
        ];
    }
}
