<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blood extends Model
{
    protected $table = 'blood';

    protected $fillable = [
        'id', 'description',
    ];

    public $timestamps = false;
}
