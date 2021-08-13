<nav>
    <ul class="sidebar_nav-menu">
    @foreach(config('menus.cms_menu') as $route => $item)
        <x-cms-menu.item :route="$route" :item="$item"/>
    @endforeach
    </ul>
</nav>
