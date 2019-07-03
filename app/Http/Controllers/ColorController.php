<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::all();
        return view('admin.color.index',compact(['colors']));
    }
    public function create()
    {
        return view('admin.color.create');
    }
    public function store(Request $r)
    {
        $r->validate([
            'name' => 'required|max:20|string|alpha'
        ]);

        $create = Color::create([
            'name' => $r->name
        ]);

        if ($create){
            createAlert("New Color has added successfully!!");
            return redirect()->route('color.index');
        }else{
            return redirect()->back();
        }
    }
    public function edit($id)
    {
        $color = Color::find($id);
        return view('admin.color.edit',compact(['color']));
    }
    public function update(Request $r,$id)
    {
        $r->validate([
            'name' => 'required|max:20|string|alpha'
        ]);

        $update = Color::find($id)->update([
            'name' => $r->name
        ]);

        if ($update){
            createAlert("The Color has edited successfully!!");
            return redirect()->route('color.index');
        }else{
            return redirect()->back();
        }
    }
    public function destroy($id)
    {
        $color = Color::find($id);
        $color->delete();
    }
}
