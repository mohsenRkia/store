<?php
/**
 * Created by PhpStorm.
 * User: l
 * Date: 25/12/2018
 * Time: 08:13 PM
 */

namespace App\Http\View\Repositories;


use App\Models\Menu;

class MenuRepository
{
    public function menuList()
    {
        $lists = Menu::all();

        return $lists;
    }
}