<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = ['title','description'];

    public function image()
    {
        return $this->morphOne(Image::class,'imageable');
    }
}
