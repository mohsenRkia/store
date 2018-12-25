<?php
/**
 * Created by PhpStorm.
 * User: l
 * Date: 25/12/2018
 * Time: 08:10 PM
 */

namespace App\Http\View\Composers;


use App\Http\View\Repositories\MenuRepository;
use Illuminate\View\View;

class MenuComposer
{
    protected $menu;
    public function __construct(MenuRepository $menu)
    {
        $this->menu = $menu;
    }


    public function compose(View $view)
    {
        $menus =  (object)$this->menu->menuList();

        $view->with(compact(['menus']));
    }

}