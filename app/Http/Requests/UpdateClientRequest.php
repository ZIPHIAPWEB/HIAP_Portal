<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
            'first_name'            =>  ['required'],
            'middle_name'           =>  ['required'],
            'last_name'             =>  ['required'],
            'address'               =>  ['required'],
            'course'                =>  ['required'],
            'school_year'           =>  ['required'],
            'contact_no'            =>  ['required'],
            'school_id'             =>  ['required'],
            'course'                =>  ['required'],
            'fb_link'               =>  ['required'],
            'program_id'            =>  ['required'],
            'alternate_email'       =>  ['required'],
            'expected_graduation'   =>  ['required']
        ];
    }
}
