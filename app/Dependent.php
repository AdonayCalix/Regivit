<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dependent extends Model
{
    protected $table = 'dependents';

    protected $fillable = [
        'id', 'name', 'relationship','age', 'address',
        'birthdate', 'general_data_id',
    ];

    public $timestamps = false;
}
