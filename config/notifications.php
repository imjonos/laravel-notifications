<?php

return [
    'model' => \App\User::class,
    'system_notification' => 'CodersStudio\Notifications\Notifications\System',
    'telegram_chat_id' => env('TELEGRAM_CHAT_ID',null)
];
