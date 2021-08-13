<div class="list-group">
    @foreach(config('menus.profile_menu') as $route => $title)
        <x-profile-menu.item :route="$route" :title="$title" />
    @endforeach
</div>
