<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function create()
    {
        $cats = Category::where('isparent',0)->paginate(10);
        $categorys = [];
        foreach ($cats as $cat){
            $item  = Category::where('isparent',$cat->id)->get();
            $categorys[$cat->name][$cat->id] = $item->toArray();
        }
        return view('admin.subcategory.create',compact(['categorys']));
    }
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
    public function destroy($id)
    {
        $subcategory = Subcategory::find($id);
        $subcategory->delete();
    }
}
