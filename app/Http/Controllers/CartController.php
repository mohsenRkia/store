<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Discount;
use App\Models\Factor;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Shetabit\Payment\Facade\Payment;
use Shetabit\Payment\Invoice;

class CartController extends Controller
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
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if (Auth::check()){
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
        }else{
            return redirect()->route('register');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function check(Request $r)
    {
        if (Auth::check()){

            $userId = Auth::id();
            $baskets = Basket::where('user_id',$userId)->with(['product' => function($q){
                $q->with('images');
            }])->get();

            $totalPriceItem = [];

            foreach ($baskets as $basket){
                $totalPriceItem[] = $basket->totalprice;
            }

            $totalPriceItem = array_filter($totalPriceItem);
            $totalPriceItem = array_sum($totalPriceItem);




            $invoice = new Invoice;

            $invoice->amount((int) $totalPriceItem);
            $invoice->detail(['id'=>$userId]);
            $invoiceAmount = $invoice->getAmount();
            $url = route('payment.verify');
            return Payment::callbackUrl($url)->purchase($invoice,function ($driver,$transactionId) use ($userId,$invoiceAmount){
                $factor = new Factor();
                $factorFind = Factor::where(['user_id'=>$userId,'status'=>0])->get();
                if (count($factorFind) == 1){
                    $factor->where(['user_id'=>$userId,'status'=>0])->update([
                        'total' => $invoiceAmount,
                        'factorcode' => $transactionId,
                        'status' => 0
                    ]);
                }else{
                    $factor->create([
                        'user_id' => $userId,
                        'total' => $invoiceAmount,
                        //Remove all 0 from first of transactioncode
                        'factorcode' => $transactionId,
                        'status' => 0
                    ]);
                }

            })->pay();




        }else{
            return redirect()->route('register');
        }

    }

    public function applyOrders()
    {

    }
}
