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
    public function destroy($id)
    {
        $item = Basket::find($id);
        $item->delete();
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
        $product = Product::with('discount')->find($id);
        $productPrice = Productprice::where('product_id',$id)->orderBy('created_at','DESC')->first();
        $price = $productPrice->originalprice;
        if ($product->offerprice){
            $price = $product->offerprice;
        }
        if ($product->discount_id){
            $value = $product->discount->value;
            $price = $price - ($price * $value / 100);
        }

        $basket->create([
            'user_id' => $userID,
            'product_id' => $id,
            'size_id' => $r->size,
            'color_id' => $r->color,
            'productqty' => $r->productqty,
            'originalprice' => ($product->offerprice)? $product->offerprice : $productPrice->originalprice,
            'totalprice' => $price * $r->productqty,
            'discount' => ($product->discount_id)? $product->discount->value : null
        ]);

        return redirect()->route('site.cart');

    }
}
