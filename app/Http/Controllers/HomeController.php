<?php

namespace App\Http\Controllers;

use App\Models\Offeritem;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        $offers = Offeritem::all();
        return view('site.home',compact(['sliders','offers']));
    }
}
