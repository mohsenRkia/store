<?php
/**
 * Created by PhpStorm.
 * User: l
 * Date: 25/12/2018
 * Time: 08:13 PM
 */

namespace App\Http\View\Repositories;


use App\Models\Category;
use App\Models\Menu;

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

        return compact(['lists','collection']);
    }
}