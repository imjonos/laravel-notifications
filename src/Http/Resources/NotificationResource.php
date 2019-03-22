<?php
namespace CodersStudio\Notifications\Http\Resources;
use Illuminate\Http\Resources\Json\Resource;
use function GuzzleHttp\json_decode;
class NotificationResource extends Resource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type'          => 'notifications',
            'id'            => (string)$this->id,
            'attributes'    => [
                'text' =>  $this->data['text'],
                'params' =>  $this->data['params'],
            ],
            'links'         => [
                'self' => $this->data['link'],
            ],
        ];
    }
}