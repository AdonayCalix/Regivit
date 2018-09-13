<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFaculty extends Model
{
    protected $table = 'users_faculties';

    protected $fillable = [
        'id', 'users_id', 'faculties_code', 'coordinator_id',
    ];

    public $timestamps = false;
}
