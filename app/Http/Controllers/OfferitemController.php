<?php

namespace App\Http\Controllers;


use App\Models\Offeritem;
use Illuminate\Http\Request;

class OfferitemController extends Controller
{
    public function index()
    {
        $offers = Offeritem::all();
        return view('admin.offeritem.index',compact(['offers']));
    }
    public function create()
    {
        return view('admin.offeritem.create');
    }
    public function store(Request $r)
    {
        $r->validate([
            'title' => 'required|max:50',
            'link' => 'required|url',
            'location' => 'required|max:2',
            'imageurl' => 'required|file|dimensions:max_width=900,min_width=200,max_height=900,min_height=200|max:1500|mimes:jpg,bmp,png,jpeg',
        ]);

        $file = $r->file('imageurl');
        $fileName = time() . "_" . $file->getClientOriginalName();
        $path = public_path() . "\uploads\images\offers";
        $move = $file->move($path,$fileName);

        if ($move){
            $location = $r->location;
            if ($location == "L" || $location == "M" || $location == "SR" || $location == "SL"){
                Offeritem::create([
                    'title' => $r->title,
                    'link' => $r->link,
                    'location' => $location,
                    'imageurl' => $fileName
                ]);

                createAlert("Your offer has added successfully");
                return redirect()->route('offeritem.index');
            }else{
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }
    }
    public function edit($id)
    {
        $offer = Offeritem::find($id);
        return view('admin.offeritem.edit',compact(['offer']));
    }
    public function update($id,Request $r)
    {
        $r->validate([
            'title' => 'required|max:50',
            'link' => 'required|url',
            'location' => 'required|max:2',
            'imageurl' => 'file|dimensions:max_width=900,min_width=200,max_height=900,min_height=200|max:1500|mimes:jpg,bmp,png,jpeg',
        ]);

            $location = $r->location;
            if ($location == "L" || $location == "M" || $location == "SR" || $location == "SL"){

                $offer = Offeritem::find($id);

                $offer->title = $r->title;
                $offer->link = $r->link;
                $offer->location = $location;
                if ($r->imageurl){
                    $file = $r->file('imageurl');
                    $fileName = time() . "_" . $file->getClientOriginalName();
                    $path = public_path() . "\uploads\images\offers";
                    $file->move($path,$fileName);
                }
                $save = $offer->save();
                if ($save){
                    createAlert("Your offer has edited successfully");
                    return redirect()->route('offeritem.index');
                }else{
                    return redirect()->back();
                }
            }else{
                return redirect()->back();
            }
    }
    public function destroy($id)
    {
        $offer = Offeritem::find($id);
        $offer->delete();
    }
}
