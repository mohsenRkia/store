<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Image;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function create()
    {
        $about = About::exists();
        if ($about){
            $aboutId = About::first();
            return redirect()->action('AboutController@edit',['id' => $aboutId->id]);
        }else{
            return view('admin.about.create');
        }
    }
    public function store(Request $r)
    {
        $r->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string|min:2',
            'image' => 'required|dimensions:max_width:400,max_height:400,min_width:100,min_height:100|between:1,1000|mimes:jpg,png,jpeg'
        ]);

        $about = About::create([
            'title' => $r->title,
            'description' => $r->description
        ]);

        if ($about){
            $file = $r->file('image');
            $path = public_path(). "/uploads/images/about/";
            $filename = time() . "_" . $file->getClientOriginalName();

            $move = $file->move($path,$filename);

            if (!$move){
                return redirect()->back();
            }

            $image = new Image(['url' => $filename]);
            $createImage = $about->image()->save($image);

            if (!$createImage){
                return redirect()->back();
            }

            createAlert("About has been edited successfully..");
            return redirect()->back();
        }else{
            warningAlert("The about page hasnt edited");
            return redirect()->back();
        }
    }
    public function show()
    {
        $about = About::with('image')->first();

        return view('site.pages.about.show',compact(['about']));

    }
    public function edit($id)
    {
        $about = About::find($id);
        return view('admin.about.edit',compact(['about']));
    }
    public function update(Request $r,$id)
    {
        $r->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string|min:2',
            'image' => 'nullable|dimensions:max_width:400,max_height:400,min_width:100,min_height:100|between:1,1000|mimes:jpg,png,jpeg'
        ]);

        $about = About::find($id);
        $updateAbout = $about->update([
            'title' => $r->title,
            'description' => $r->description
        ]);

        if ($updateAbout){
            if ($r->file('image')){
                $file = $r->file('image');
                $path = public_path(). "/uploads/images/about/";
                $filename = time() . "_" . $file->getClientOriginalName();

                $move = $file->move($path,$filename);

                if (!$move){
                    return redirect()->back();
                }
                $image = Image::where(['imageable_id' => $id,'imageable_type' => About::class])->first();
                $updateImage = $image->update([
                    'url' => $filename
                ]);

                if (!$updateImage){
                    return redirect()->back();
                }
            }

            editAlert("Your about page has updated successfully..");
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }
}
