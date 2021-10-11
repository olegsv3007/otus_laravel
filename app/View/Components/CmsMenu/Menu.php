<?php

namespace App\View\Components\CmsMenu;

use Illuminate\View\Component;

class Menu extends Component
{
    public $userRoles;

    public function __construct()
    {
        $this->userRoles = auth()->user()->roles->pluck('name');
    }

    public function render()
    {
        return view('components.cms-menu.menu');
    }
}
