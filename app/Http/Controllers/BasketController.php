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
    public function show()
    {
        $userId = Auth::id();
        $baskets = Basket::where('user_id',$userId)->with(['product' => function($q){
            $q->with('images');
            $q->with('discount');
        }])->get();

        $totalPriceItem = [];

        foreach ($baskets as $basket){
            $totalPriceItem[] = $basket->totalprice;
        }

        $totalPriceItem = array_filter($totalPriceItem);
        $totalPriceItem = array_sum($totalPriceItem);

        //dd($baskets->toArray());
        return view('site.pages.product.cart',compact(['baskets','totalPriceItem']));

    }
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
