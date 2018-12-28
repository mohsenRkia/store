<?php

namespace App\Http\Controllers;

use App\Models\Offeritem;
use App\Models\Specialoffer;
use Illuminate\Http\Request;

class SpecialofferController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $special = Specialoffer::orderBy('id','DESC')->first();

        //dd($special);
        return view('admin.special.create',compact(['special']));
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
            'title' => 'required|max:40',
            'link' => 'required|url',
            'discountvalue' => 'required|numeric|max:99',
            'description' => 'required|max:250',
            'urlimage' => 'required|file|dimensions:max_width=1920,min_width=1024,max_height=900,min_height=400|max:1500|mimes:jpg,bmp,png,jpeg',
        ]);

        $file = $r->file('urlimage');
        $fileName = time() . "_" . $file->getClientOriginalName();
        $path = public_path() . "\uploads\images\special";
        $move = $file->move($path,$fileName);
        if ($move){
            $create = Specialoffer::create([

                'title' => $r->title,
            'link' => $r->link,
            'discountvalue' => $r->discountvalue,
            'description' => $r->description,
            'urlimage' => $fileName
        ]);

            if ($create){
                createAlert("Your special offer has added successfully");
                return redirect()->back();
            }else{
                return redirect()->back();
            }


        }else{
            return redirect()->back();
        }


    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Specialoffer  $specialoffer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r,$id)
    {
        $r->validate([
            'title' => 'required|max:40',
            'link' => 'required|url',
            'discountvalue' => 'required|numeric|max:99',
            'description' => 'required|max:250',
            'urlimage' => 'file|dimensions:max_width=1920,min_width=1024,max_height=900,min_height=400|max:1500|mimes:jpg,bmp,png,jpeg',
        ]);

        $special = Specialoffer::find($id);
        $special->title = $r->title;
        $special->link = $r->link;
        $special->discountvalue = $r->discountvalue;
        $special->description = $r->description;
        if ($r->urlimage){
            $file = $r->file('urlimage');
            $fileName = time() . "_" . $file->getClientOriginalName();
            $path = public_path() . "\uploads\images\special";
            $move = $file->move($path,$fileName);
            if (!$move){
                return redirect()->back();
            }
        }
        $save = $special->save();
        if ($save){
            createAlert("Your special offer has edited successfully");
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }
}
