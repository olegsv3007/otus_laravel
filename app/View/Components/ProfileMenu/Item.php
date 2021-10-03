<?php

namespace App\View\Components\ProfileMenu;

use Illuminate\Support\Facades\App;
use Illuminate\View\Component;

class Item extends Component
{
    public bool $active;

    public function __construct(public string $route, public string $title) {
        $locale = App::getLocale();
        $this->active = (get_url_segment(route($this->route, ['locale' => $locale]), 2) == request()->segment(2));
    }

    public function render()
    {
        return view('components.profile-menu.item');
    }
}
