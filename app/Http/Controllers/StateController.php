<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::with('states')->get();

        return view('admin.location.state.list',compact(['countries']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('admin.location.state.create',compact(['countries']));
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

    /**
     * Display the specified resource.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $state = State::where('id',$id)->with('country')->first();
        $countries = Country::all();

        return view('admin.location.state.edit',compact(['state','countries']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $state = State::find($id);
        $state->delete();
    }
}
