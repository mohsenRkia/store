<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Comment;
use App\Models\Discount;
use App\Models\Image;
use App\Models\Product;
use App\Models\Productprice;
use App\Models\Setting;
use App\Models\Size;
use App\Models\Subcategory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['prices'=>function($pr){
            $pr->select('id','product_id','originalprice');
        }])->get();
        //dd($products->toArray());
        return view('admin.post.index',compact(['products']));
    }
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
            'subcategory' => 'required',
            'subcategory.*' => 'required|numeric',
            'discount_id' => 'nullable|numeric',
            'color' => 'nullable',
            'color.*' => 'numeric',
            'size' => 'nullable',
            'size.*' => 'numeric'
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
                    $image = new Image(['url' => $fileName]);
                    $createImage = $create->images()->save($image);

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
                return redirect()->route('product.index');
            }else{
                $product = Product::find($create->id);
                if ($product->delete()){
                    warningAlert("Product hasn't added");
                    return redirect()->back();
                }
            }

        }

    }
    public function show($id,$slug)
    {
        $product = Product::with('discount')->with(['prices' => function($pr){
            $pr->orderBy('id','DESC')->first();
        }])->with('colors')->with('sizes')->with('images')->with('subcategorys')->with(['comments' => function($c){
            $c->with(['user' => function($u){
                $u->with('image');
            }]);
            $c->orderBy('id','DESC');
        }])->find($id);

        $setting = Setting::first();

        $subIds = [];
        foreach ($product->subcategorys as $subcategory){
            $subIds[] = $subcategory->id;
        }
        $similars = Product::whereHas('subcategorys',function ($s) use ($subIds){
            $s->where('subcategory_id',$subIds[0]);
        })->with(['prices' => function($prc){
            $prc->orderBy('id','DESC');
        }])->with('images')->get();

        //dd($similars->toArray());
        if ($slug == $product->slug){
            return view('site.pages.product.view',compact(['product','setting','similars']));
        }else{
            return redirect()->route('home.index');
        }
    }
    public function edit($id)
    {
        $product = Product::with('user:id,name')->with('discount:id,discountcode')->with('sizes')->with('subcategorys')->with('colors')->with(['prices'=>function($pr){
            $pr->select('id','product_id','originalprice');
        }])->with('images')->find($id);
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
        //dd($product->toArray());
        return view('admin.post.edit',compact(['product','discounts','colors','sizes','authors','categorys']));
    }
    public function update(Request $r,$id)
    {
        $r->validate([
            'user_id' => 'required|numeric',
            'name' => 'required|string|max:150',
            'description' => 'required|string',
            'images' => 'nullable',
            'images.*' => 'image|dimensions:max_width:1000,max_height:1000,min_height:100,min_width:100|between:20,1000',
            'originallprice' => 'required|',
            'offerprice' => 'nullable|numeric',
            'quantity' => 'required|numeric|max:1000',
            'weight' => 'nullable|numeric',
            'subcategory' => 'required',
            'subcategory.*' => 'numeric',
            'discount_id' => 'nullable|numeric',
            'color' => 'nullable',
            'color.*' => 'numeric',
            'size' => 'nullable',
            'size.*' => 'numeric'
        ]);

        $update = Product::find($id)->update([
            'user_id' => $r->user_id,
            'name' => $r->name,
            'discount_id' => $r->discount_id,
            //'slug' => str_slug($r->name,'-'),
            'description' => $r->description,
            'productquantity' => $r->quantity,
            'offerprice' => $r->offerprice,
            'weight' => $r->weight,
            'salable' => 1,
        ]);
        $product = Product::find($id);
        if ($update){
                Productprice::create([
                    'product_id' => $id,
                    'originalprice' => $r->originallprice
                ]);

                $product->sizes()->detach();
                if ($r->size){
                    foreach ($r->size as $size){
                        $product->sizes()->attach($size);
                    }
                }
                $product->colors()->detach();
                if ($r->color){
                    foreach ($r->color as $color){
                        $product->colors()->attach($color);
                    }
                }

                $product->subcategorys()->detach();
                foreach ($r->subcategory as $sub){
                    $product->subcategorys()->attach($sub);
                }


            if ($r->file('images')){
                $files = $r->file('images');
                $path = public_path() . "/uploads/images/products/";
                foreach ($files as $file) {
                    $fileName = time() . $file->getClientOriginalName();
                    $move = $file->move($path, $fileName);
                    if ($move) {
                        $image = new Image(['url' => $fileName]);
                        $createImage = $product->images()->save($image);

                    }else{
                            warningAlert("Product hasn't added");
                            return redirect()->back();
                    }
                }
            }

            createAlert("The Product has been edited successfully!");
            return redirect()->back();

        }


    }

    public function deleteimage($id)
    {
        $image = Image::find($id);
        $file = "images/products/" . $image->url;
        Storage::disk('public_uploads')->delete($file);
        $image->delete();
    }
    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product->delete()){
            $images = Image::where('imageable_id',$id)->delete();
        }
    }

    public function draft(Request $r)
    {
        $r->validate([
            'user_id' => 'required|integer',
            'name' => 'required|string|max:150',
            'description' => 'required|string',
            'images' => 'required',
            'images.*' => 'image|dimensions:max_width:1000,max_height:1000,min_height:100,min_width:100|between:20,1000',
            'originallprice' => 'required|',
            'offerprice' => 'nullable|numeric',
            'quantity' => 'required|integer|max:1000',
            'weight' => 'nullable|numeric',
            'subcategory' => 'required',
            'subcategory.*' => 'integer',
            'discount_id' => 'nullable|integer',
            'color.*' => 'nullable|integer',
            'size.*' => 'nullable|integer'
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


    public function getlist($productId)
    {
        $images = Image::where('imageable_type',Product::class)->where('imageable_id',$productId)->get();
        return json_encode($images);
    }


}
