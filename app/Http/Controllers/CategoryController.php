<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorys = Category::all();
        return view('admin.category.create',compact(['categorys']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        $validate = $r->validate([
            'name' => 'required|alpha_num|max:30',
            'isparent' => 'required|numeric'
        ]);

        if ($validate){

            $name = $r->name;
            $isparent = $r->isparent;

            Category::create([
                'name' => $name,
                'isparent' => $isparent
            ]);
            createAlert("New Categry has added!");
            return redirect()->route('category.list');
        }else{
            return redirect()->back();
        }



    }

    public function list()
    {
        $cats = Category::where('isparent',0)->paginate(10);
        $categorys = [];
        foreach ($cats as $cat){
           $item  = Category::where('isparent',$cat->id)->get();
            $categorys[$cat->name][$cat->id] = $item->toArray();
        }
        return view('admin.category.list',compact(['categorys']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $allCategory = Category::all();
        $category = Category::find($id);
        if ($category->isparent == 0){
            $parent = 0;
        }else{
            $parent = Category::where('id',$category->isparent)->first();
        }
        return view('admin.category.edit',compact(['allCategory','category','parent']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $r)
    {
        $validate = $r->validate([
            'name' => 'required|alpha_num|max:30',
            'isparent' => 'required|numeric'
        ]);

        if ($validate){
            $category = Category::find($id);
            $category->name = $r->name;
            $category->isparent = $r->isparent;
            if ($category->save()){
                createAlert("Your Categry has edited successfully!");
                return redirect()->route('category.list');
            }else{
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if ($category->delete()){
            return $category;
        }else{
            return redirect()->back();
        }
    }
}
