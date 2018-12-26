<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.menu.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        $validate = $r->validate([
            'name' => 'required|alpha_num|max:20',
            'link' => 'required|url'
        ]);

        if ($validate){
            $menu = Menu::create([
                'name' => $r->name,
                'link' => $r->link
            ]);
            if ($menu){
                createAlert("Your menu has added successfully");
                return redirect()->route('menu.list');
            }else{
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }
    }

    public function list()
    {
        $menus = Menu::paginate(10);
        return view('admin.menu.list',compact(['menus']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::find($id);
        return view('admin.menu.edit',compact(['menu']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $r)
    {
        $validate = $r->validate([
            'name' => 'required|alpha_num|max:20',
            'link' => 'required|url'
        ]);

        if ($validate){
            $menu = Menu::find($id);

            $menu->name = $r->name;
            $menu->link = $r->link;

            if ($menu->save()){
                editAlert("Your menu has edited successfully!");
                return redirect()->route('menu.list');
            }else{
                return redirect()->back();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);

        if ($menu->delete()){
            return $menu;
        }else{
            return redirect()->back();
        }
    }
}
