<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Product;
use App\Models\Productprice;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Basket  $basket
     * @return \Illuminate\Http\Response
     */
    public function show(Basket $basket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Basket  $basket
     * @return \Illuminate\Http\Response
     */
    public function edit(Basket $basket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Basket  $basket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Basket $basket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Basket  $basket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Basket $basket)
    {
        //
    }

    public function addtobasket($id,Request $r)
    {
        $r->validate([
            'size' => 'required|integer',
            'color' => 'required|integer',
            'productqty' => 'required|integer|gt:0|lte:10'
        ]);
        $userID = Auth::id();
        $basket = new Basket();
        $product = Product::find($id);
        $price = Productprice::where('product_id',$id)->orderBy('created_at','DESC')->first();
        $price = $price->originalprice;
        if ($product->offerprice){
            $price = $product->offerprice;
        }

        $basket->create([
            'user_id' => $userID,
            'product_id' => $id,
            'size_id' => $r->size,
            'color_id' => $r->color,
            'productqty' => $r->productqty,
            'originalprice' => $price,
            'totalprice' => $price * $r->productqty
        ]);

        return redirect()->route('site.cart');

    }
}
