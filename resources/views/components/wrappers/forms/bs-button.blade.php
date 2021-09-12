
@props(['title'])

<button {{ $attributes->merge(['class' => 'btn']) }}>
    {{ $title }}
</button>
