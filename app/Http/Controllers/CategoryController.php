<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index');
    }
    public function create()
    {
        $categorys = Category::where('isparent',0)->get();

        return view('admin.category.create',compact(['categorys']));
    }
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
           $item  = Category::where('isparent',$cat->id)->with('subcategories')->get();
            $categorys[$cat->name][$cat->id] = $item->toArray();
        }
        return view('admin.category.list',compact(['categorys']));
    }
    public function show($name)
    {
        $category = Category::where('name',$name)->first();
        if (!is_null($category)){
            if ($category->isparent == 0){
                $categorys = Category::where('isparent',$category->id)->get();

                $collections = [];
                foreach ($categorys as $cat){
                    $subcats = Subcategory::where('category_id',$cat->id)->get();
                    foreach ($subcats as $subcat){
                        if ($subcat){
                            $subcattt[] = $subcat;
                            $collections = [];
                            foreach ($subcattt as $sub){

                                $p = Product::whereHas('subcategorys' , function($s) use ($sub){
                                    $s->where('subcategory_id',$sub->id);
                                })->with('images')->get();

                                if (count($p) > 0){
                                    $collections[] = $p;
                                }

                            }

                        }

                    }
                }
                return view('site.pages.category.index',compact(['collections']));
            }else{
                return redirect()->route('home.index');
            }

        }else{
            return redirect()->route('home.index');
        }

    }

    public function showSubs($first,$second){
        $category = Category::where('name',$first)->first();
        $checksecond = Category::where('name',$second)->where('isparent' , $category->id)->first();

        if (!is_null($category) && !is_null($checksecond)){
            if ($category->isparent == 0){

                $collections = [];
                    $subcats = Subcategory::where('category_id',$checksecond->id)->get();
                    foreach ($subcats as $subcat){
                        if ($subcat){

                            $subcattt[] = $subcat;
                            foreach ($subcattt as $sub){

                                $p = Product::whereHas('subcategorys' , function($s) use ($sub){
                                    $s->where('subcategory_id',$sub->id);
                                })->with('images')->get();

                                $collections[] = $p;
                            }
                        }
                    }
                return view('site.pages.category.subcategory',compact(['collections']));
            }else{
                return redirect()->route('home.index');
            }

        }else{
            return redirect()->route('home.index');
        }
    }
    public function edit($id)
    {
        $allCategory = Category::where('isparent',0)->get();
        $category = Category::find($id);
        if ($category->isparent == 0){
            $parent = 0;
        }else{
            $parent = Category::where('id',$category->isparent)->first();
        }
        return view('admin.category.edit',compact(['allCategory','category','parent']));
    }
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
