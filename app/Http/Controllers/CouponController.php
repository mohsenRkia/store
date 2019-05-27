<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::orderBy('id','DESC')->paginate(5);
        return view('admin.coupon.index',compact(['coupons']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r,Coupon $c)
    {
        $r->validate([
            'name' => 'required|string|max:50|',
            'value' => 'required|integer|between:1,99|'
        ]);

        $create = $c->create([
            'name' => $r->name,
            'value' => $r->value
        ]);

        if (!$create){
            return redirect()->back();
        }
        createAlert('Your Coupon has added successfuly!!');
        return redirect()->route('coupon.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = Coupon::find($id);

        return view('admin.coupon.edit',compact(['coupon']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, $id)
    {
        $r->validate([
            'name' => 'required|max:50|string',
            'value' => 'required|between:1,99'
        ]);

        $coupon = Coupon::find($id);
        $coupon->name = $r->name;
        $coupon->value = $r->value;
        $save = $coupon->save();

        if (!$save){
            return redirect()->back();
        }

        createAlert('Your coupon epdated successfully!!');
        return redirect()->route('coupon.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Coupon::find($id)->delete();
    }
}
