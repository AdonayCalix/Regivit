<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'education';

    protected $fillable = [
        'id', 'school_name', 'degree', 'start_year', 'end_year', 'level',
        'general_data_id'
    ];

    public $timestamps = false;
}
