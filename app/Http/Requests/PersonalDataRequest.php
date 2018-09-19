<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonalDataRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'personal_school_number' => 'nullable|string',
            'diver_license' => 'nullable|string',
            'job_card' => 'nullable|string',
            'admission_date' => 'nullable|date',
            'campus_id' => 'nullable|alpha_num',
            'bamer_account_number' => 'nullable|string',
            'spouse_name' => 'nullable|string',
            'emergency' => 'required|string',
            'emergency_number' => 'required|alpha_num|min:8|max:15',
            'current_date' => 'required|date',
            'current_position' => 'required|string',
            'signature_path' => 'required|string',
            'dependent_name.*' => 'nullable|string',
            'dependent_relationship.*' => 'nullable|string',
            'dependent_birthdate.*' => 'nullable|date',
            'postgrado' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
          'emergency.required' => 'Debes de incluir el nombre de una persona en case que ocurra una emergencia',
          'emergency_number.required' => 'Debes de incluir el numero de una persona en caso que ocurra una emergencia',
          'current_position.required' => 'Debes de incluir tu posición actual'
        ];
    }
}
