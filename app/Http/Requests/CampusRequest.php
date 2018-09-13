<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampusRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'campus_code' => 'required|string|unique:campus,campus_code',
            'name' => 'required|string',
            'city' => 'required|string'
        ];
    }
}
