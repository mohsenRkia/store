<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $sizes = Size::all();
        return view('admin.size.index',compact(['sizes']));
    }
    public function create()
    {
        return view('admin.size.create');
    }
    public function store(Request $r)
    {
        $r->validate([
            'name' => 'required|max:30|string'
        ]);

        $create = Size::create([
            'name' => $r->name
        ]);

        if ($create){
            createAlert("New Size has added successfully!!");
            return redirect()->route('size.index');
        }else{
            return redirect()->back();
        }
    }
    public function edit($id)
    {
        $size = Size::find($id);
        return view('admin.size.edit',compact(['size']));
    }
    public function update(Request $r,$id)
    {
        $r->validate([
            'name' => 'required|max:30|string'
        ]);

        $update = Size::find($id)->update([
           'name' => $r->name
        ]);

        if ($update){
            createAlert("The size has edited successfully!!");
            return redirect()->route('size.index');
        }else{
            return redirect()->back();
        }
    }
    public function destroy($id)
    {
        $delete = Size::find($id);
        $delete->delete();
    }
}
