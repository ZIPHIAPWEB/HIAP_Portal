<?php

namespace App\Http\Requests\Lobster;

use Illuminate\Foundation\Http\FormRequest;

class UploadSingleLobsterRequest extends FormRequest
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
            'cert_id'           =>  'required',
            'full_name'         =>  'required',
            'school'            =>  'required',
            'course'            =>  'required',
            'hours'             =>  'required',
            'lobster_layout_id' =>  'required',
            'cert_id_main'      =>  'required'
        ];
    }
}
