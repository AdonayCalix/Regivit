<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'documents';

    protected $fillable = ['id, name, tab, visibility, faculties_code, users_id'];

    public $timestamps = false;
}
