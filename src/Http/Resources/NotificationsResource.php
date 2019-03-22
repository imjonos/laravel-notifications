<?php
namespace CodersStudio\Notifications\Http\Resources;
use CodersStudio\Notifications\Http\Resources\NotificationResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class NotificationsResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => NotificationResource::collection($this->collection),
        ];
    }
}