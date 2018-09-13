<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    protected $table = 'campus';

    protected $fillable = [
        'id', 'campus_code', 'name', 'city', 'status',
    ];

    public $timestamps = false;
}
