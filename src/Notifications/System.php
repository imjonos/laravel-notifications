<?php

namespace CodersStudio\Notifications\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class System extends Notification
{
    use Queueable, SerializesModels, ShouldQueue;

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
        $via = ['database', 'broadcast'];
        if (config('notifications.telegram_chat_id') && !empty($this->params['telegram'])) {
            $via[] = TelegramChannel::class;
        }
        if (!empty($this->params['mail']) && !empty($this->params['title'])) {
            $via[] = 'mail';
        }
        return $via;
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

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject($this->params['title'])
            ->line($this->text);
    }

    /**
     * Send notification to telegram chat
     * @param $notifiable
     * @return TelegramMessage
     */
    public function toTelegram($notifiable)
    {
        $message = TelegramMessage::create()
            ->to(config('notifications.telegram_chat_id'))
            ->content($this->text);
        if ($this->link) {
            $message = $message->button('->', url($this->link));
        }
        return $message;
    }
}
