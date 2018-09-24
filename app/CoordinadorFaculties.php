<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoordinadorFaculties extends Model
{
    protected $table = 'coordinator_faculties';

    protected $fillable = [
        'id', 'users_id', 'faculties_code'
    ];

    public $timestamps = false;
}
