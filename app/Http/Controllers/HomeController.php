<?php

namespace App\Http\Controllers;

use App\Models\Offeritem;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Specialoffer;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::with(['prices' => function($pr){
            $pr->orderBy('id','DESC')->first();
        }])->with('images')->get();
        $sliders = Slider::all();
        $offers = Offeritem::all();
        $special = Specialoffer::orderBy('id','DESC')->first();
        return view('site.home',compact(['sliders','offers','special','products']));
    }

}
