<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralData extends Model
{
    protected $table = 'general_data';

    protected $fillable = [
        'id', 'address', 'nationality', 'ihss', 'rap', 'birthdate', 'catholic_movement',
        'users_id', 'civil_status',
    ];

    public $timestamps = false;
}
