<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Cart;
use App\Models\Factor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Shetabit\Payment\Exceptions\InvalidPaymentException;
use Shetabit\Payment\Facade\Payment;

class PaymentController extends Controller
{
    public function verify()
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



            try {
                $factor = Factor::where(['user_id'=>$userId,'status'=>0])->first();
                $amount = (int)$totalPriceItem;
                $transaction_id = $factor->factorcode;
                Payment::amount($amount)->transactionId($transaction_id)->verify();

                $cart = new Cart();
                foreach($baskets as $basket){
                    $submit = $cart->create([
                        'user_id' => $basket->user_id,
                        'product_id' => $basket->product_id,
                        'factor_id' => $factor->id,
                        'productqty' => $basket->productqty,
                        'totalprice' => $basket->totalprice

                    ]);
                    if ($submit){
                        Basket::find($basket->id)->delete();
                        $factor->update([
                            'status' => 1
                        ]);
                    }
                }

                return view('site.payment.verify');
            } catch (InvalidPaymentException $exception) {
                /**
                when payment is not verified , it throw an exception.
                we can catch the excetion to handle invalid payments.
                getMessage method, returns a suitable message that can be used in user interface.
                 **/
                $error = $exception->getMessage();
                return view('site.payment.unverified',compact(['error']));
            }




        }else{
            return redirect()->route('register');
        }
    }

    public function unverified()
    {
        echo 'unverified';
    }
}
