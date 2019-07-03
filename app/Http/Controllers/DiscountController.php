<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::all();
        return view('admin.discount.index',compact(['discounts']));
    }
    public function create()
    {
        return view('admin.discount.create');
    }
    public function store(Request $r)
    {
        $r->validate([
            'code' => 'required|string|max:30',
            'value' => 'required|numeric|max:100|min:1'
        ]);

        $create = Discount::create([
            'discountcode' => $r->code,
            'value' => $r->value
        ]);
        if ($create){
            createAlert("New discount has added successfully!!");
            return redirect()->route('discount.index');
        }else{
            return redirect()->back();
        }
    }
    public function edit($id)
    {
        $discount = Discount::find($id);
        return view('admin.discount.edit',compact(['discount']));
    }
    public function update(Request $r,$id)
    {
        $r->validate([
            'code' => 'required|string|max:30',
            'value' => 'required|numeric|max:100|min:1'
        ]);

        $update = Discount::find($id)->update([
            'discountcode' => $r->code,
            'value' => $r->value
        ]);

        if ($update){
            createAlert("The discount has edited successfully!!");
            return redirect()->route('discount.index');
        }else{
        return redirect()->back();

        }

    }
    public function destroy($id)
    {
        $discount = Discount::find($id);
        $discount->delete();
    }
}
