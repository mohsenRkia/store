<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Offeritem;
use App\Models\Product;
use App\Models\Satisfiedcostumer;
use App\Models\Slider;
use App\Models\Specialoffer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


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

        $carts = Cart::select('product_id')
            ->selectRaw('SUM(productqty) AS total')
            ->groupBy(DB::raw('product_id'))
            ->orderByDesc('total')
            ->limit(2)
            ->whereBetween('created_at', [Carbon::now()->subMonth(),Carbon::now()])
            ->with(['product' => function($p){
                $p->with('images');
            }])
            ->get();

        $satisfiedComments = Satisfiedcostumer::with(['user' => function($u){
            $u->with('image');
            $u->with(['profile'=>function($p){
                $p->with(['state' => function($s){
                    $s->with('country');
                }]);
            }]);
        }])->take(5)->get();

        //dd($satisfiedComments->toArray());
        return view('site.home',compact(['sliders','offers','special','products','carts','satisfiedComments']));
    }

}
