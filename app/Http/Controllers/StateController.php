<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index()
    {
        $countries = Country::with('states')->get();

        return view('admin.location.state.list',compact(['countries']));
    }
    public function create()
    {
        $countries = Country::all();
        return view('admin.location.state.create',compact(['countries']));
    }
    public function store(Request $r)
    {
        $r->validate([
            'name' => 'required|max:70',
            'country_id' => 'required|numeric'
        ]);

        $create = State::create([
            'name' => $r->name,
            'country_id' => $r->country_id
        ]);

        if ($create){
            createAlert("Your State has added successfully!!");
            return redirect()->route('state.list');
        }else{
            return redirect()->back();
        }
    }
    public function edit($id)
    {
        $state = State::where('id',$id)->with('country')->first();
        $countries = Country::all();

        return view('admin.location.state.edit',compact(['state','countries']));
    }
    public function update(Request $r,$id)
    {
        $r->validate([
            'name' => 'required|max:70',
            'country_id' => 'required|numeric'
        ]);

        $state = State::find($id);
        $state->name = $r->name;
        $state->country_id = $r->country_id;
        $edit = $state->save();

        if ($edit){
            createAlert("Your State has edited successfully");
            return redirect()->route('state.list');
        }else{
            return redirect()->back();
        }

    }
    public function destroy($id)
    {
        $state = State::find($id);
        $state->delete();
    }
}
