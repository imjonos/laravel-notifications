<?php
namespace CodersStudio\Notifications\Http\Resources;
use Illuminate\Http\Resources\Json\Resource;
use function GuzzleHttp\json_decode;
use Carbon\Carbon;
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
                'text' =>  $this->data['text'] ?? null,
                'date' =>  Carbon::parse($this->created_at)->format('d.m.Y h:i'),
                'params' =>  $this->data['params'] ?? null,
            ],
            'links'         => [
                'self' => $this->data['link'] ?? null,
            ],
        ];
    }
}