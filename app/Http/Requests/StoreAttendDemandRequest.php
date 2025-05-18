<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttendDemandRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'date' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'date.required' => 'حقل التاريخ مطلوب',
        ];
    }
}
