<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $table = 'job_application';

    protected $fillable = [
        'id', 'place_birth', 'pastoral_activity', 'family_university', 'minimum_salary',
        'signature_path', 'married_surname', 'aspire_position', 'general_data_id', 'parish_id',
        'parish_priest_id', 'blood_id, age, telefono, celular'
    ];

    public $timestamps = false;
}
