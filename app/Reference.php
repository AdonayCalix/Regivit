<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    protected $table = 'references';

    protected $fillable = [
        'id', 'name', 'address', 'relationship', 'number', 'general_data_id',
    ];

    public $timestamps = false;
}
