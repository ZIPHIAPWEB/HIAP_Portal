<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProgramRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'program_id'            =>  ['required'],
            'courses'               =>  ['required'],
            'start_date'            =>  ['required'],
            'end_date'              =>  ['required'],
            'hours_needed'          =>  ['required'],
            'application_status'    =>  ['required']
        ];
    }
}
