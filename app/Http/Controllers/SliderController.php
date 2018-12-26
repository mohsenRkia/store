<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index',compact(['sliders']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
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
            'bigtitle' => 'required|max:15',
            'smalltitle' => 'required|max:15',
            'reason' => 'required|max:50',
            'description' => 'required|max:120',
            'location' => 'required|max:1',
            'link' => 'required|url',
            'urlimage' => 'required|file|dimensions:max_width=1920,min_width=1024,max_height=900,min_height=400|max:1500|mimes:jpg,bmp,png,jpeg',
        ]);


            $file = $r->file('urlimage');
            $fileName = time() . "_" . $file->getClientOriginalName();
            $path = public_path() . "\uploads\images\slider";
            $move = $file->move($path,$fileName);

            if ($move){
                if ($r->location == "R" || $r->location == "L"){
                    $location = $r->location;

                    $slider = Slider::create([
                        'bigtitle' => $r->bigtitle,
                        'smalltitle' => $r->smalltitle,
                        'reason' => $r->reason,
                        'description' => $r->description,
                        'urlimage' => $fileName,
                        'location' => $location,
                        'link' => $r->link
                    ]);

                    if ($slider){
                        createAlert("Your slide has added successfully");
                        return redirect()->route('slider.index');
                    }else{
                        return redirect()->back();
                    }
                }else{
                    return redirect()->back();
                }


            }else{
                return redirect()->back();
            }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slide = Slider::find($id);
        return view('admin.slider.edit',compact(['slide']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $r)
    {
        $r->validate([
            'bigtitle' => 'required|max:15',
            'smalltitle' => 'required|max:15',
            'reason' => 'required|max:50',
            'location' => 'required|max:1',
            'link' => 'required|url',
            'description' => 'required|max:120',
            'urlimage' => 'file|dimensions:max_width=1920,min_width=1024,max_height=900,min_height=400|max:1500|mimes:jpg,bmp,png,jpeg',
        ]);

        if ($r->location === "R" || $r->location === "L") {
            $location = $r->location;

            $slide = Slider::find($id);
            $slide->bigtitle = $r->bigtitle;
            $slide->smalltitle = $r->smalltitle;
            $slide->reason = $r->reason;
            $slide->location = $location;
            $slide->link = $r->link;
            $slide->description = $r->description;
            if ($r->urlimage) {
                $file = $r->file('urlimage');
                $fileName = time() . "_" . $file->getClientOriginalName();
                $path = public_path() . "\uploads\images\slider";
                $move = $file->move($path, $fileName);
                if ($move) {
                    $slide->urlimage = $fileName;
                }
            }
            $save = $slide->save();
            if ($save) {
                createAlert("Your slide has edited successfully");
                return redirect()->route('slider.index');
            } else {
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slide = Slider::find($id);

        $slide->delete();
    }
}
