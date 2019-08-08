<?php
namespace CodersStudio\Notifications\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use CodersStudio\Notifications\Http\Resources\NotificationsResource;
use Auth;

class NotificationsController extends BaseController
{
    protected $model;

    /**
     * Список не прочитанных сообщений
     *
     * @param int $id
     * @return json
     */
    public function index($id)
    {
        if($id!=Auth::id()) abort(403, 'Access denied');
        $messages = $this->getModel()::findOrFail($id)
            ->unreadNotifications()
            ->where('type', 'CodersStudio\Notifications\Notifications\System')
            ->get();
        return new NotificationsResource($messages); 
    }

    /**
     * Отметить как прочитанное
     *
     * @param int $id
     * @param int $messageId
     * @return response
     */
    public function setRead($id, $messageId){
        if($id!=Auth::id()) abort(403, 'Access denied');
        $user = $this->getModel()::findOrFail($id);
        $user->unreadNotifications->where('id', $messageId)->markAsRead();
        return response(null, 204);
    }

    /**
     * Отметить как прочитанное все сообщения
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function readAll($id)
    {
        if($id!=Auth::id()) abort(403, 'Access denied');
        $messages = $this->getModel()::findOrFail($id)
            ->unreadNotifications()
            ->where('type', 'CodersStudio\Notifications\Notifications\System')
            ->get()
            ->markAsRead();
          
        return response(null, 204);
    }

    /**
     * Возращает модель
     *
     * @return Model
     */
    protected function getModel(){
        if(!$this->model){
            $this->model = config('notifications.model'); 
        }
        return $this->model;
    }
}