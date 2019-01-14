<?php

namespace App\Http\Controllers;

use App\File;
use App\Models\Category;
use App\Models\Color;
use App\Models\Discount;
use App\Models\Image;
use App\Models\Product;
use App\Models\Productprice;
use App\Models\Size;
use App\Models\Subcategory;
use App\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['prices'=>function($pr){
            $pr->select('id','product_id','originalprice');
        }])->get();
        //dd($products->toArray());
        return view('admin.post.index',compact(['products']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $discounts = Discount::all();
        $colors = Color::all();
        $sizes = Size::all();
        $authors = User::where('level_id',1)->get();
        $cats = Category::where('isparent',0)->paginate(10);
        $categorys = [];
        foreach ($cats as $cat){
            $item  = Category::where('isparent',$cat->id)->with('subcategories')->get();
            $categorys[$cat->name][$cat->id] = $item->toArray();
        }
        return view('admin.post.create',compact(['authors','categorys','discounts','colors','sizes']));
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
            'user_id' => 'required|numeric',
            'name' => 'required|string|max:150',
            'description' => 'required|string',
            'images' => 'required',
            'images.*' => 'image|dimensions:max_width:1000,max_height:1000,min_height:100,min_width:100|between:20,1000',
            'originallprice' => 'required|',
            'offerprice' => 'nullable|numeric',
            'quantity' => 'required|numeric|max:1000',
            'weight' => 'nullable|numeric',
            'subcategory.*' => 'required|numeric',
            'discount_id' => 'nullable|numeric',
            'color.*' => 'nullable|numeric',
            'size.*' => 'nullable|numeric'
        ]);
        $create = Product::create([
            'user_id' => $r->user_id,
        'name' => $r->name,
        'discount_id' => $r->discount_id,
        'slug' => str_slug($r->name,'-'),
        'productcode' => productCode(),
        'description' => $r->description,
        'productquantity' => $r->quantity,
        'offerprice' => $r->offerprice,
        'weight' => $r->weight,
        'salable' => 1,
        ]);

        if ($create){
            $files = $r->file('images');
            $path = public_path() . "/uploads/images/products/";
            foreach ($files as $file) {
                $fileName = time() . $file->getClientOriginalName();
                $move = $file->move($path, $fileName);
                if ($move) {
                    $createImage = Image::create([
                        'url' => $fileName,
                        'imageable_id' => $create->id,
                        'imageable_type' => "app\product"
                    ]);

                }else{
                    $product = Product::find($create->id);
                    if ($product->delete()){
                        warningAlert("Product hasn't added");
                        return redirect()->back();
                    }
                }
            }
            if ($createImage){
                Productprice::create([
                    'product_id' => $create->id,
                    'originalprice' => $r->originallprice
                ]);
                $product = Product::find($create->id);
                foreach ($r->size as $size){
                    $product->sizes()->attach($size);
                }
                foreach ($r->color as $color){
                    $product->colors()->attach($color);
                }
                foreach ($r->subcategory as $sub){
                    $product->subcategorys()->attach($sub);
                }

                createAlert("New Product has been added successfully!");
                return redirect()->back();
            }else{
                $product = Product::find($create->id);
                if ($product->delete()){
                    warningAlert("Product hasn't added");
                    return redirect()->back();
                }
            }

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function draft(Request $r)
    {
        $r->validate([
            'user_id' => 'required|numeric',
            'name' => 'required|string|max:150',
            'description' => 'required|string',
            'images' => 'required',
            'images.*' => 'image|dimensions:max_width:1000,max_height:1000,min_height:100,min_width:100|between:20,1000',
            'originallprice' => 'required|',
            'offerprice' => 'nullable|numeric',
            'quantity' => 'required|numeric|max:1000',
            'weight' => 'nullable|numeric',
            'subcategory' => 'required',
            'subcategory.*' => 'numeric',
            'discount_id' => 'nullable|numeric',
            'color.*' => 'nullable|numeric',
            'size.*' => 'nullable|numeric'
        ]);
        $create = Product::create([
            'user_id' => $r->user_id,
            'name' => $r->name,
            'discount_id' => $r->discount_id,
            'slug' => str_slug($r->name,'-'),
            'productcode' => productCode(),
            'description' => $r->description,
            'productquantity' => $r->quantity,
            'offerprice' => $r->offerprice,
            'weight' => $r->weight,
            'salable' => 0,
        ]);

        if ($create){
            $files = $r->file('images');
            $path = public_path() . "/uploads/images/products/";
            foreach ($files as $file) {
                $fileName = time() . $file->getClientOriginalName();
                $move = $file->move($path, $fileName);
                if ($move) {
                    $createImage = Image::create([
                        'url' => $fileName,
                        'imageable_id' => $create->id,
                        'imageable_type' => "app\product"
                    ]);

                }else{
                    $product = Product::find($create->id);
                    if ($product->delete()){
                        warningAlert("Product hasn't added");
                        return redirect()->back();
                    }
                }
            }
            if ($createImage){
                Productprice::create([
                    'product_id' => $create->id,
                    'originalprice' => $r->originallprice
                ]);
                $product = Product::find($create->id);
                foreach ($r->size as $size){
                    $product->sizes()->attach($size);
                }
                foreach ($r->color as $color){
                    $product->colors()->attach($color);
                }
                foreach ($r->subcategory as $sub){
                    $product->subcategorys()->attach($sub);
                }

                createAlert("New Product has been added successfully!");
                return redirect()->back();
            }else{
                $product = Product::find($create->id);
                if ($product->delete()){
                    warningAlert("Product hasn't added");
                    return redirect()->back();
                }
            }

        }

    }



}
