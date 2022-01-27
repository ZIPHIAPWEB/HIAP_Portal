<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientDashboardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $this->withoutWrapping();

        return [
            'id'                    =>  $this->id,
            'user_id'               =>  $this->user_id,
            'first_name'            =>  $this->first_name,
            'middle_name'           =>  $this->middle_name,
            'last_name'             =>  $this->last_name,
            'address'               =>  $this->address,
            'course'                =>  $this->course,
            'school_year'           =>  $this->school_year,
            'contact_no'            =>  $this->contact_no,
            'school_id'             =>  $this->school_id,
            'program_id'            =>  $this->program_id,
            'school'                =>  $this->school()->first(),
            'alternate_email'       =>  $this->alternate_email,
            'fb_link'               =>  $this->fb_link,
            'expected_graduation' =>    $this->expected_graduation,
            'expected_graduation_formatted'   =>  ($this->expected_graduation == '') ? '' : Carbon::instance(new DateTime($this->expected_graduation))->format('M Y'),
            'user'                  =>  $this->user()->first(),
            'created_at'            =>  $this->created_at
        ];
    }
}
