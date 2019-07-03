<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        return view('admin.menu.index');
    }
    public function create()
    {
        return view('admin.menu.create');
    }
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
    public function edit($id)
    {
        $menu = Menu::find($id);
        return view('admin.menu.edit',compact(['menu']));
    }
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
