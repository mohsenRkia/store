<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countrys = Country::all();
        return view('admin.location.country.list',compact(['countrys']));
    }
    public function create()
    {
        return view('admin.location.country.create');
    }
    public function store(Request $r)
    {
        $r->validate([
            'name' => 'required|max:60'
        ]);

        $create = Country::create([
            'name' => $r->name
        ]);
        if ($create){
            createAlert("Your Country has added successfully!");
            return redirect()->route("state.list");
        }else{
            return redirect()->back();
        }
    }
    public function edit($id)
    {
        $country = Country::find($id);
        return view('admin.location.country.edit',compact(['country']));
    }
    public function update(Request $r,$id)
    {
        $r->validate([
            'name' => 'required|max:60'
        ]);

        $country = Country::find($id);
        $country->name = $r->name;

        if ($country->save()){
            createAlert("Your Country has edited successfully!");
            return redirect()->route("state.list");
        }else{
            return redirect()->back();
        }

    }
    public function destroy($id)
    {
        $country = Country::find($id);
        $country->delete();
    }
}
