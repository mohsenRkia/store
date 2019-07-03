<?php

namespace App\Http\View\Composers;

use App\Http\View\Repositories\AdminNavbarRepository;
use Illuminate\View\View;

class AdminNavbarComposer
{
    protected $navbar;

    public function __construct(AdminNavbarRepository $navbar)
    {
        $this->navbar = $navbar;
    }
    public function compose(View $view)
    {
        $userClass = (object)$this->navbar->getProfile();

        $userInfo = $userClass->user;


        $view->with(compact(['userInfo']));
    }
}