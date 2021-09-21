<nav>
    <ul class="sidebar_nav-menu">
    @foreach(config('menus.cms_menu') as $route => $item)
        @if (!isset($item['role']) || auth()->user()->hasRole($item['role']))
            <x-cms-menu.item :route="$route" :item="$item"/>
        @endif
    @endforeach
    </ul>
</nav>
