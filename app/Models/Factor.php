<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Factor extends Model
{
    protected $fillable = ['factorcode','user_id','subtotalprice','deliveryprice','total','status','sent'];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
