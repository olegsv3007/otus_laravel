<li>
    <a href="{{ route($route, ['locale' => $locale]) }}" class="sidebar_nav-menu_item {{ $active ? 'active' : '' }}">
        <x-dynamic-component :component="$item['icon']" /><span class="title">{{ __($item['title']) }}</span>
    </a>
</li>
