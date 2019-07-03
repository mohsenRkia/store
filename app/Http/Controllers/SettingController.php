<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::all();
        $countSetting = count(Setting::all());

        return view('admin.settings.index',compact(['setting','countSetting']));
    }
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
}
