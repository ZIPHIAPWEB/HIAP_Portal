<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CertificateRequest extends FormRequest
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
            'cert_no'       =>  'required',
            'name'          =>  'required',
            'school'        =>  'required',
            'program'       =>  'required',
            'gold_medal'    =>  'required',
            'silver_medal'  =>  'required',
            'bronze_medal'  =>  'required',
            'total_medal'   =>  'required',
            'total_grade'   =>  'required',
            'proficiency'   =>  'required'
        ];
    }
}
