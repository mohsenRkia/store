<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $r,$id)
    {
        $r->validate([
            'commenttxt' => 'required|string',
            'username' => 'sometimes|required|string'
        ]);
        $user = User::find(Auth::id());
        $userId = Auth::id();
        $body = $r->commenttxt;

        $create = Comment::create([
            'body' => $body,
            'user_id' => $userId,
            'name' => ($r->username)? $r->username : null,
            'commentable_id' =>$id,
            'commentable_type' =>Product::class
        ]);

        if ($create){
            createAlert("Your Comment has sent successfully");
        }

        return redirect()->back();
    }
}
