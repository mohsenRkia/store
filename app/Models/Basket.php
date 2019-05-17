<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'size_id',
        'color_id',
        'productqty',
        'originalprice',
        'totalprice'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }


}
