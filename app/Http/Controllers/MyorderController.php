<?php

namespace App\Http\Controllers;

use App\Models\Factor;
use Illuminate\Http\Request;

class MyorderController extends Controller
{
    public function index($id)
    {
        $sentLists = Factor::where(['user_id' => $id,'sent' => 1])->with('carts')->orderBy('id','DESC')->get();
        $pendLists = Factor::where(['user_id' => $id,'sent' => 0])->with('carts')->orderBy('id','DESC')->get();
        $i = 0;
        //dd($pendLists->toArray());
        return view('user.myorder.index',compact(['sentLists','pendLists','i']));
    }

    public function show($id)
    {
        $factor = Factor::with(['carts' => function($c){
            $c->with(['product' => function($p){
                $p->with('images');
            }]);
        }])->find($id);

        return view('user.myorder.show',compact(['factor']));
    }
}
