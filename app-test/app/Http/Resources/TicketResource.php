<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [

            'type' => 'tickets',
            'id' => $this->id,
            'user_id' => $this->user->id,
            'info' => [
                'title' => $this->title,
                'desc' => $this->desc,


            ],
            // 'author' => [
            //     new UserResource($this->user),
            // ]

        ];
    }
}
