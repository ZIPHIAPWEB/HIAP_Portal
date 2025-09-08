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
            'first_name'    =>  'required',
            'last_name'     =>  'required',
            'address'       =>  'required',
            'contact_number'=>  'required',
            'fb_link'           =>  'required',
            'alternate_email'   =>  'required',
            'affiliation'       =>  'required',
            'date_of_birth'     =>  'required',
            'hours_needed'      =>  'required',
            'returnee'          =>  'required',
            'start_date'        =>  'required',
            'end_date'          =>  'required',

            'school_year'   =>  'required_if:affiliation,student',
            'course'        =>  'required_if:affiliation,student',
            'section'       =>  'required_if:affiliation,student',
            'expected_graduation'   =>  'required_if:affiliation,student',

            'industry_id' =>  'required_if:affiliation,!=,employee',
            'company'   =>  'required_if:affiliation,!=,employee'
        ];
    }
}
