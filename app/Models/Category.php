<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categorys";
    protected $fillable = ['name','isparent'];

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
}
