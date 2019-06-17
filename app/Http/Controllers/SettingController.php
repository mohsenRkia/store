<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::all();
        $countSetting = count(Setting::all());

        return view('admin.settings.index',compact(['setting','countSetting']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'comment' => 'integer|between:0,1',
            'login_to_comment' => 'integer|between:0,1'
        ]);

        $create = Setting::create([
            'comment' => $r->comment,
            'login_to_comment' => $r->logintocomment
        ]);

        if ($create){
            createAlert("Your setting saved successfully");
            return redirect()->back();
        }else{

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, $id)
    {
        $r->validate([
            'comment' => 'integer|between:0,1',
            'login_to_comment' => 'integer|between:0,1'
        ]);

        $setting = Setting::find($id);

        $update = $setting->update([
            'comment' => $r->comment,
            'login_to_comment' => $r->logintocomment
        ]);

        if ($update){
            createAlert("Your setting saved successfully");
            return redirect()->back();
        }else{

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
