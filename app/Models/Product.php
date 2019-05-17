<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['user_id','slug','name','discount_id','productcode','description','productquantity','salable','weight','offerprice'];

    public function sizes()
    {
        return $this->belongsToMany(Size::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class,'imageable');
    }
    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }
    public function subcategorys()
    {
        return $this->belongsToMany(Subcategory::class);
    }

    public function prices()
    {
        return $this->hasMany(Productprice::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function baskets()
    {
        return $this->belongsToMany(Basket::class);
    }
}


