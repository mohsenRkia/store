<?php
/**
 * Created by PhpStorm.
 * User: l
 * Date: 25/12/2018
 * Time: 08:13 PM
 */

namespace App\Http\View\Repositories;


use App\Models\Basket;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class MenuRepository
{
    public function menuList()
    {
        $lists = Menu::all();
        $categories = Category::where('isparent',0)->get();

        $collection = [];
        foreach ($categories as $cat){
            $subCategories = Category::where('isparent',$cat->id)->get();

            $collection[$cat->name][] = $subCategories;
        }

        $cartCount = count(Basket::where('user_id',Auth::id())->get());
        return compact(['lists','collection','cartCount']);
    }
}