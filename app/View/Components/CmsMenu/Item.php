<?php

namespace App\View\Components\CmsMenu;

use Illuminate\Support\Facades\App;
use Illuminate\View\Component;

class Item extends Component
{
    public $active;

    public function __construct(
        public string $route,
        public array $item
    )
    {
        $locale = App::getLocale();
        $this->active = (get_url_segment(route($this->route, ['locale' => $locale]), 3) == request()->segment(3));
    }

    public function render()
    {
        return view('components.cms-menu.item');
    }
}
