<?php
Route::middleware('web', 'auth')->group(function () {
    Route::pattern('id', '[0-9]+');
    Route::pattern('messageId', '[0-9a-z-]+');
    Route::get('/users/{id}/notifications', '\CodersStudio\Notifications\Http\Controllers\NotificationsController@index')->name('codersstudio.notifications.index');
    Route::patch('/users/{id}/notifications/{messageId}', '\CodersStudio\Notifications\Http\Controllers\NotificationsController@setRead')->name('codersstudio.notifications.setread');
});