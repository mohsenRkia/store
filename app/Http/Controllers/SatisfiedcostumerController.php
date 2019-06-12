<?php

namespace App\Http\Controllers;

use App\Models\Satisfiedcostumer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SatisfiedcostumerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $satisfiedCms = Satisfiedcostumer::with('user')->orderBy('updated_at','DESC')->get();

        return view('admin.satisfied.index',compact(['satisfiedCms']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userid = Auth::id();
        $satisfied = Satisfiedcostumer::where('user_id',$userid)->first();


        return view('admin.satisfied.create',compact(['satisfied']));
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
            'body' => 'required|string|max:255'
        ]);

        $userid = Auth::id();

        $create = Satisfiedcostumer::create([
            'user_id' => $userid,
            'body' => $r->body
        ]);

        createAlert('Your Message Has Been Created Successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Satisfiedcostumer  $satisfiedcostumer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cm = Satisfiedcostumer::with(['user' => function($u){
            $u->with('image');
            $u->with(['profile'=>function($p){
                $p->with(['state' => function($s){
                    $s->with('country');
                }]);
            }]);
        }])->find($id);

        //dd($cm->toArray());
        return view('admin.satisfied.show',compact(['cm']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Satisfiedcostumer  $satisfiedcostumer
     * @return \Illuminate\Http\Response
     */
    public function edit(Satisfiedcostumer $satisfiedcostumer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Satisfiedcostumer  $satisfiedcostumer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r,$id)
    {
        $r->validate([
            'body' => 'required|string|max:255'
        ]);

        $userid = Auth::id();

        $satisfied = Satisfiedcostumer::find($id);

        $update = $satisfied->update([
            'status' => 0,
            'body' => $r->body
        ]);

        editAlert('Your Message Has Been Updated Successfully..');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Satisfiedcostumer  $satisfiedcostumer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cm = Satisfiedcostumer::find($id);
        $cm->delete();

        return redirect()->back();
    }

    public function showusercm()
    {
        $userid = Auth::id();
        $satisfied = Satisfiedcostumer::where('user_id',$userid)->first();

        return view('user.comments.satisfy',compact(['satisfied']));
    }

    public function addusercm(Request $r)
    {
        $r->validate([
            'body' => 'required|string|max:255'
        ]);

        $userid = Auth::id();

        $create = Satisfiedcostumer::create([
            'user_id' => $userid,
            'body' => $r->body
        ]);

        createAlert('Your Message Has Been Created Successfully');
        return redirect()->back();
    }

    public function editusercm(Request $r,$id)
    {
        $r->validate([
            'body' => 'required|string|max:255'
        ]);

        $satisfied = Satisfiedcostumer::find($id);

        $update = $satisfied->update([
            'status' => 0,
            'body' => $r->body
        ]);

        if ($update){
            editAlert('Your Message Has Been Updated Successfully..');
        }


        return redirect()->back();
    }

    public function active($id,Request $r)
    {
        $status = $r->status;
        $comment = Satisfiedcostumer::find($id);
        $update = $comment->update([
            'status' => $status
        ]);

        return $comment->status;
    }
}
