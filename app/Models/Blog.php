<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'slug'
    ];


    public function image()
    {
        return $this->morphOne(Image::class,'imageable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
