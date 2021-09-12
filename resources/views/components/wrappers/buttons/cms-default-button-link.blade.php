
@props(['href', 'title'])

<a {{ $attributes->merge(['class' =>'d-flex justify-content-center align-items-center btn']) }} href="{{ $href }}">
    @if ($slot)
        {{ $slot }}
        <span class="pr-2"></span>
    @endif
    {{ $title }}
</a>
