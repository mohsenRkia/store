<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sizes = Size::all();
        return view('admin.size.index',compact(['sizes']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.size.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function show(Size $size)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $size = Size::find($id);
        return view('admin.size.edit',compact(['size']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Size::find($id);
        $delete->delete();
    }
}
