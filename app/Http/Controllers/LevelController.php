<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index()
    {
        $levels = Level::all();
        return view('admin.level.index',compact(['levels']));
    }
    public function create()
    {
        return view('admin.level.create');
    }
    public function store(Request $r)
    {
        $r->validate([
            'name' => 'required|max:50'
        ]);

        $create = Level::create([
            'title' => $r->name
        ]);

        if ($create){
            createAlert("Your Level has added successfully!!");
            return redirect()->route('level.index');
        }else{
            return redirect()->back();
        }
    }
    public function edit($id)
    {
        $level = Level::find($id);
        return view('admin.level.edit',compact(['level']));
    }
    public function update(Request $r,$id)
    {
        $r->validate([
            'name' => 'required|max:50'
        ]);

        $level = Level::find($id);
        $level->title = $r->name;
        $save = $level->save();
        if ($save){
            createAlert("Your Level has edited successfully!!");
            return redirect()->route('level.index');
        }else{
            return redirect()->back();
        }
    }
    public function destroy($id)
    {
        $level = Level::find($id);
        $level->delete();
    }
}
