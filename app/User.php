<?php

namespace App;

use App\Models\Image;
use App\Models\Product;
use App\Models\Profile;
use App\Models\Satisfiedcostumer;
use App\Models\State;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','level_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class,'imageable');
    }

    public function satisfied()
    {
        return $this->belongsTo(Satisfiedcostumer::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
