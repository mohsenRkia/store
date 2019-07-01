<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::paginate(5);
        return view('admin.contactus.index',compact('messages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('site.pages.contactus.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $message = Message::find($id);
        return view('admin.contactus.edit',compact(['message']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = Message::find($id);
        $message->delete();
    }

    public function send(Request $r)
    {
        $r->validate([
            'fname' => 'required|string|max:100',
            'lname' => 'required|string|max:100',
            'email' => 'required|string|email',
            'subject' => 'required|string|max:200',
            'message' => 'required|string'
        ]);

        $create = Message::create([
            'firstname' => $r->fname,
            'lastname' => $r->lname,
            'email' => $r->email,
            'subject' => $r->subject,
            'message' => $r->message
        ]);

        if ($create){
            createAlert("Your message has been sent successfully..");
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }
}
