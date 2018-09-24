<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    protected $table = 'revision';

    protected $fillable = ['id, form, status, users_id'];

    public $timestamps = false;
}
