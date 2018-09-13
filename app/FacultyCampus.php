<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyCampus extends Model
{
    protected $table = 'faculties_campus';

    protected $fillable = [
        'id', 'faculties_code', 'campus_id',
    ];

    public $timestamps = false;
}
