<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'factor_id',
        'productqty',
        'totalprice',
        'discount'];

    public function product()
    {
       return $this->belongsTo(Product::class);
    }

    public function factor()
    {
        return $this->belongsTo(Factor::class);
    }

}
