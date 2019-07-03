<?php
/**
 * Created by PhpStorm.
 * User: l
 * Date: 03/07/2019
 * Time: 03:29 PM
 */

namespace App\Http\View\Repositories;


use App\User;
use Illuminate\Support\Facades\Auth;

class AdminNavbarRepository
{
    public function getProfile()
    {
        $user = User::with('image')->find(Auth::id());
        return compact(['user']);
    }
}