<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExperienceJob extends Model
{
    protected $table = 'experiences_job';

    protected $fillable = [
        'id', 'company_name', 'position', 'experience_age', 'general_data_id',
    ];

    public $timestamps = false;
}
