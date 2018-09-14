<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalData extends Model
{
    protected $table = 'personal_data';

    protected $fillable = [
        'id', 'personal_school_number', 'driver_license', 'job_card', 'admission_date',
        'campus_job', 'bamer_account_numer', 'spouse_name', 'emergency', 'emergency_number',
        'currendt_date', 'current_position', 'signature_path', 'general_data_id', 'parish_id',
        'parish_priest_id', 'vehiculo', 'marca', 'modelo_vehiculo', 'anio_vehiculo', 'posgrado',
        'telefono_casa', 'telefono_oficina', 'telefono_otro'
    ];

    public $timestamps = false;
}
