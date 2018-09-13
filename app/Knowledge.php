<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Knowledge extends Model
{
    protected $table = 'knowledges';

    protected $fillable = [
        'id', 'description', 'general_data_id',
    ];

    public $timestamps = false;
}
