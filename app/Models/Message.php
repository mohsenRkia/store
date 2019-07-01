<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'subject',
        'message'
    ];
}
