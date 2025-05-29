<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
    'data'=>[
    'id' => $this->id,
    'name' => $this->name,
    'email' =>  $this->when($request->routeIs('users.show'),$this->email),
    'created_at' => $this->when($request->routeIs('users.show'),$this->created_at->format('Y-m-d H:i:s'),),
    'updated_at' => $this->when($request->routeIs('users.show'),$this->updated_at->format('Y-m-d H:i:s'),),
    ],
    'tickets'=>[
  'ticket_id' => optional($this->tickets->first())->id,
    'tickets' => TicketResource::collection($this->tickets),
    ]
];

}

}
