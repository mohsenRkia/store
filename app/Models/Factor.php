<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factor extends Model
{
    protected $fillable = ['factorcode','user_id','subtotalprice','deliveryprice','total','status'];
}
