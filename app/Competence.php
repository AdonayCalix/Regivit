<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    protected $table = 'competencies';

    protected $fillable = [
        'id', 'description', 'general_data_id',
    ];

    public $timestamps = false;
}
