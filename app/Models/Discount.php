<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = ['discountcode','value'];

    public function baskets()
    {
        return $this->belongsToMany(Basket::class);
    }
}
