<?php

namespace App\View\Components\CmsMenu;

use Illuminate\View\Component;

class Item extends Component
{
    public $active;

    public function __construct(
        public string $route,
        public array $item
    )
    {
        $this->active = (get_url_segment(route($this->route), 2) == request()->segment(2));
    }

    public function render()
    {
        return view('components.cms-menu.item');
    }
}
