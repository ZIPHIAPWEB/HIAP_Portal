<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ModeratorClientListResource extends JsonResource
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
            'id'        =>  $this->id,
            'user_id'   =>  $this->user_id,
            'application_status'    =>  $this->application_status,
            'email'     =>  $this->user->email,
            'returnee'  =>  $this->returnee,
            'program'   =>  $this->program->name,   
            'client'    =>  new ClientResource($this->client)
        ];
    }
}
