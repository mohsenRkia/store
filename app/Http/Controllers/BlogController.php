<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('user')->get();
        return view('admin.blog.list',compact(['blogs']));
    }
    public function create()
    {
        return view('admin.blog.create');
    }
    public function store(Request $r)
    {
        $r->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string|min:2'
        ]);

        $blog = Blog::create([
            'user_id' => Auth::id(),
            'title' => $r->title,
            'description' => $r->description,
            'slug' => str_slug($r->title,'-')
        ]);

        if ($blog){
            $file = $r->file('image');
            $path = public_path(). "/uploads/images/blog/";
            $filename = time() . "_" . $file->getClientOriginalName();

            $move = $file->move($path,$filename);

            if (!$move){
                return redirect()->back();
            }

            $image = new Image(['url' => $filename]);
            $createImage = $blog->image()->save($image);

            if (!$createImage){
                return redirect()->back();
            }

            createAlert("New blog has been created successfully..");
            return redirect()->route('admin.blog.index');
        }else{
            return redirect()->back();
        }
    }
    public function show($id,$slug)
    {
        $blog = Blog::with('image')->find($id);

        if ($blog->slug === $slug){
            return view('site.pages.blog.show',compact(['blog']));
        }else{
            return redirect()->route('home.index');
        }
    }
    public function edit($id)
    {
        $blog = Blog::find($id);
        return view('admin.blog.edit',compact(['blog']));
    }
    public function update(Request $r,$id)
    {
        $r->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string|min:2'
        ]);

        $blog = Blog::find($id);
        $updateBlog = $blog->update([
            'title' => $r->title,
            'description' => $r->description
        ]);

        if ($updateBlog){
            if ($r->file('image')){
                $file = $r->file('image');
                $path = public_path(). "/uploads/images/blog/";
                $filename = time() . "_" . $file->getClientOriginalName();

                $move = $file->move($path,$filename);

                if (!$move){
                    return redirect()->back();
                }
                $image = Image::where(['imageable_id' => $id,'imageable_type' => Blog::class])->first();
                $updateImage = $image->update([
                    'url' => $filename
                ]);

                if (!$updateImage){
                    return redirect()->back();
                }
            }

            editAlert("Your blog has been updated successfully..");
            return redirect()->route('admin.blog.index');
        }else{
            return redirect()->back();
        }
    }
    public function destroy($id)
    {
        $blog = Blog::find($id);
        $blog = $blog->delete();

        if ($blog){
            $image = Image::where(['imageable_id' => $id,'imageable_type' => Blog::class])->first();
                $image->delete();
        }

        return redirect()->back();
    }
}
