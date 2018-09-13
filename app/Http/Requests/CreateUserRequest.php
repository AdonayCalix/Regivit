<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'identity' => 'required|string|unique:users,identity|size:13',
            'first_name' => 'required|alpha',
            'second_name' => 'required|alpha',
            'first_surname' => 'required|alpha',
            'second_surname' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|alpha_dash',
            'user_type' => 'required|alpha_num',
            'faculty' => 'required_if:user_type,2'
        ];
    }

    public function messages()
    {
        return [
            'identity.required' => 'Debes incluir el número de identidad',
            'identity.unique' => 'El número de identidad ya esta siendo usado',
            'identity.size' => 'El número de identidad debe tener 13 números',
            'email.unique' => 'El correo ya esta siendo usado',
            'first_name.required' => 'El primer nombre es obligatorio!',
            'second_name.required' => 'El segundo nombre es obligatorio!',
            'first_surname.required' => 'El primer apellido es obligatorio!',
            'second_surname.required' => 'El segundo apellido es obligatorio!',
            'email.required' => 'Debes incluir un correo electronico',
            'password.required' => 'Debes agregar una contraseña!',
            'password.min' => 'La contraseña debe de contener un minimo de 8 caracteres',
            'user_type.required' => 'Debes de indicar que tipo de usuario vas a crear!',
            'faculty.required_if' => 'Debes de especificar la facultad(es) que se asignaran'
        ];
    }

    public function withValidator()
    {

    }
}
