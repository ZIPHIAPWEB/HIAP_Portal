<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendApplicationRequest extends FormRequest
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
            'last_name'             =>  ['required'],
            'address'               =>  ['required'],
            'school_year'           =>  ['required'],
            'contact_number'        =>  ['required'],
            'school'                =>  ['required'],
            'course_id'             =>  ['required'],
            'fb_link'               =>  ['required'],
            'alternate_email'       =>  ['required'],
            'course'                =>  ['required'],
            'expected_graduation'   =>  ['required'],
            'returnee'              =>  ['required'],
            'section'               =>  ['required']
        ];
    }
}
