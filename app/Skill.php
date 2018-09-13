<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = 'skills';

    protected $fillable = [
        'id', 'description', 'general_data_id',
    ];

    public $timestamps = false;
}
