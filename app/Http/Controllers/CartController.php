<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Discount;
use App\Models\Factor;
use Carbon\Carbon;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Shetabit\Payment\Facade\Payment;
use Shetabit\Payment\Invoice;

class CartController extends Controller
{
    public function index()
    {
        $factors = Factor::where(['status' => 1,'sent' => 0])->with('carts')->with('user')->orderBy('id','DESC')->paginate(5);
        return view('admin.cart.index',compact(['factors']));
    }

    public function indexSent()
    {
        $factors = Factor::where(['status' => 1,'sent' => 1])->with('carts')->with('user')->orderBy('id','DESC')->paginate(5);
        return view('admin.cart.indexsent',compact(['factors']));
    }
    public function show($id)
    {
        $factor = Factor::with(['carts' => function($c){
            $c->with(['product' => function($p){
                $p->with('images');
            }]);
        }])->with(['user' => function($u){
            $u->with('profile');
        }])->find($id);

        //dd($factor->toArray());
        return view('admin.cart.show',compact(['factor']));
    }
    public function check(Request $r)
    {
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
            return Payment::callbackUrl($url)->purchase($invoice,function ($driver,$transactionId) use ($r,$userId,$invoiceAmount){
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
                        'factorcode' => $transactionId,
                        'status' => 0
                    ]);
                }

            })->pay();
    }

}
