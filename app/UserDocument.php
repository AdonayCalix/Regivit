<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDocument extends Model
{
    protected $table = 'users_documents';

    protected   $fillable = ['id', 'status', 'created_at', 'updated_at',
        'document_id', 'users_id'];

    public $timestamps = true;
}
