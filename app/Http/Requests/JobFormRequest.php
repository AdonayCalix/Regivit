<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobFormRequest extends FormRequest
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
            'address' => 'required|string|max:255',
            'nationality' => 'required|alpha',
            'birthdate' => 'required|date',
            'catholic_movement' => 'string',
            'pastoral_activity' => 'required|alpha_num',
            'family_university' => 'required|alpha_num',
            'signature_paht' => 'string',
            'aspire_position' => 'required|string',
            'knowledge.*' => 'required|string',
            'competence.*' => 'required|string',
            'skill.*' => 'required|string',
            'reference.*' => 'required|string',
            'blood' => 'required|alpha_num',
            'civil_status' => 'required|alpha_num',
            'age' => 'required|alpha_num|min:2|max:3',
            'parish' => 'required|alpha_num',
            'priest' => 'required|alpha_num',
            'education_school_name.*' => 'required|string',
            'education_years.*' => 'required|string',
            'education_degree.*' => 'required|string',
            'minimun_salary' => 'required|alpha_num',
            'place_date' => 'required|string',
            'dependent_name.*' => 'nullable|string',
            'dependent_relationship.*' => 'nullable|alpha',
            'dependent_age.*' => 'nullable|alpha_num',
            'dependent_address.*' => 'nullable|string',
            'company_name' => 'nullable|string',
            'position' => 'nullable|string',
            'worked_years' => 'nullable|alpha_num',
            'activity.*' => 'nullable|string',
            'telefono' => 'nullable|alpha_num',
            'celular' => 'required|alpha_num'
        ];
    }

    public function messages()
    {
        return [
            'address.required' => 'Debes de incluir la dirección donde vives',
            'nationality.required' => 'Debes de incluir la nacionalidad',
            'birthdate.required' => 'Debes de incluir tu fecha de nacimiento',
            'birthdate.required' => 'Debes de incluir tu fecha de nacimiento',
            'pastoral_activity.required' => 'Debes elegir si deseas participar en pastoral',
            'family_university.required' => 'Debes que decirnos si tienes familia en la universidad',
            'aspire_position.required' => 'Debes de incluir tu posición actual',
            'blood.required' => 'Debes de indicar que tipo de sangre tienes',
            'civil_status.required' => 'Debes de indicar tu estado civil',
            'age.required' => 'Debes de indicar tu edad',
            'parish.required' => 'Es necesario indicar la parroquia a la que asiste',
            'priest.required' => 'Debes de indicar el nombre del parroco',
            'minimun_salary' => 'Debes de indicar el salario minimo',
            'celular.required' => 'Debe de incluir tu número de celular',
            'celular.alpha_num' => 'El número de telefono no debe incluir letras',
            'telefono.alpha_num' => 'El número de telefono no debe incluir letras',
            'knowledge.0.required' => 'Debes de incluir el primer concocimiento!',
            'knowledge.1.required' => 'Debes de incluir el segundo concocimiento!',
            'knowledge.2.required' => 'Debes de incluir el tercer concocimiento!',
            'knowledge.3.required' => 'Debes de incluir el cuarto concocimiento!',
            'knowledge.4.required' => 'Debes de incluir el quinto concocimiento!',
            'knowledge.5.required' => 'Debes de incluir el sexto concocimiento!',
            'skill.0.required' => 'Debes de incluir la primer habilidad!',
            'skill.1.required' => 'Debes de incluir la segunda habilidad!',
            'skill.2.required' => 'Debes de incluir la tercera habilidad!',
            'skill.3.required' => 'Debes de incluir la cuarta habilidad!',
            'skill.4.required' => 'Debes de incluir la quinta habilidad!',
            'skill.5.required' => 'Debes de incluir la sexta habilidad!',
            'competence.0.required' => 'Debes de incluir la primer competencia!',
            'competence.1.required' => 'Debes de incluir la primer competencia!',
            'competence.2.required' => 'Debes de incluir la primer competencia!',
            'competence.3.required' => 'Debes de incluir la primer competencia!',
            'competence.4.required' => 'Debes de incluir la primer competencia!',
            'competence.5.required' => 'Debes de incluir la primer competencia!'
        ];
    }
}
