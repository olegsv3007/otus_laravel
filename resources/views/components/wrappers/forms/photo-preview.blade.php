
@props(['src', 'title'])

<div class="card mt-3">
    <div class="card-body">
        <p class="card-text">{{ $title }}</p>
    </div>
    <img class="card-img-bottom" src="{{ $src }}" alt="{{ $title }}">
</div>
