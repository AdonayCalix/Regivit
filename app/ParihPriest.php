<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParihPriest extends Model
{
    protected $table = 'parish_priest';

    protected $fillable = [
        'id', 'name',
    ];

    public $timestamps = false;
}
