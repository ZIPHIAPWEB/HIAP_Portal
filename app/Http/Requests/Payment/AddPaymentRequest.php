<?php

namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;

class AddPaymentRequest extends FormRequest
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
            'purpose'       =>  'required',
            'file'          =>  'required',
            'mop'           =>  'required',
            'date_paid'     =>  'required',
            'amount_paid'   =>  'required',
            'program_fee'   =>  'required',
            'course_id'     =>  'required'
        ];
    }
}
