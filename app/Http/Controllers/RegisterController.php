<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(Request $r,User $user)
    {
        $r->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|string|max:255|unique:users',
            'password' => 'required|string|confirmed|min:6'
        ]);

        $user->name = $r->name;
        $user->email = $r->email;
        $user->password = Hash::make($r->password);

        if ($user->save()){
            $profile = new Profile();
            $profile->user_id = $user->id;
            if ($profile->save()){
                $user->sendEmailVerificationNotification();
                return redirect()->route('admin.index');
            }

        }else{
            return redirect()->back();
        }
    }
}
