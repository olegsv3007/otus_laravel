<?php

namespace App\View\Components\ProfileMenu;

use Illuminate\View\Component;

class Item extends Component
{
    public bool $active;

    public function __construct(public string $route, public string $title) {
        $this->active = (get_url_segment(route($this->route), 1) == request()->segment(1));
    }

    public function render()
    {
        return view('components.profile-menu.item');
    }
}
