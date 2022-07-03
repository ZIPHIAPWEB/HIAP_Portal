<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'id'                    =>  $this->id,
            'user_id'               =>  $this->user_id,
            'first_name'            =>  $this->first_name,
            'middle_name'           =>  $this->middle_name,
            'last_name'             =>  $this->last_name,
            'course'                =>  $this->course,
            'school_year'           =>  $this->school_year,
            'contact_no'            =>  $this->contact_no,
            'school'                =>  $this->school()->first(),
            'section'               =>  $this->section,
            'program'               =>  ($this->onlineProgram == null) ? '' : $this->onlineProgram->name,
            'alternate_email'       =>  $this->alternate_email,
            'expected_graduation'   =>  $this->expected_graduation,
            'created_at'            =>  $this->created_at->toDateTimeString()
        ];
    }
}
