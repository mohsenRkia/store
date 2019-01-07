<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
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
        $cats = Category::where('isparent',0)->paginate(10);
        $categorys = [];
        foreach ($cats as $cat){
            $item  = Category::where('isparent',$cat->id)->get();
            $categorys[$cat->name][$cat->id] = $item->toArray();
        }
        //dd($categorys);
        return view('admin.subcategory.create',compact(['categorys']));
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
            'name' => 'required|alpha_num|max:30',
            'category_id' => 'required|numeric'
        ]);

        $create = Subcategory::create([
            'name' => $r->name,
            'category_id' => $r->category_id
        ]);

        if ($create){
            createAlert("New Subcategory has added successfully!");
            return redirect()->route('category.list');
        }else{
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subcategory = Subcategory::find($id)->with('category')->first();
        $parent = Category::where(['id' => $subcategory->category->isparent,'isparent' => 0])->first();
        $cats = Category::where('isparent',0)->paginate(10);
        $categorys = [];
        foreach ($cats as $cat){
            $item  = Category::where('isparent',$cat->id)->get();
            $categorys[$cat->name][$cat->id] = $item->toArray();
        }
        return view('admin.subcategory.edit',compact(['categorys','subcategory','parent']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r,$id)
    {
        $r->validate([
            'name' => 'required|alpha_num|max:30',
            'category_id' => 'required|numeric'
        ]);

        $update = Subcategory::find($id)->update([
            'name' => $r->name,
            'category_id' => $r->category_id
        ]);

        if ($update){
            createAlert("The Subcategory has edited successfully!");
            return redirect()->route('category.list');
        }else{
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategory = Subcategory::find($id);
        $subcategory->delete();
    }
}
