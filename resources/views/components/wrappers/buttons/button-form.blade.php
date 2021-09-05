
@props(['method', 'route', 'class', 'id', 'title'])

<form class="form-invisible" action="{{ $route }}" method="post" id="{{ $id }}">
    @csrf
    @method($method)
</form>

<button class="btn btn-form {{ $class }}" data-form="{{ $id }}">
    @if ($slot)
        {{ $slot }}
    @endif
    {{ $title }}
</button>
