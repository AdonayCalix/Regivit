<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLimitTime extends Model
{
    protected $table = 'users_limit_time';

    protected $fillable = ['id', 'users_id', 'start_date', 'end_date'];

    public $timestamps = false;
}
