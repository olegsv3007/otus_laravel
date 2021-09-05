
@props(['path', 'images', 'title'])

<div class="card mt-3">
    <div class="card-body">
        <p class="card-text">{{ $title }}</p>
    </div>
    <div class="row p-3">
        @forelse($images as $image)
            <div class="col-4 justify-content-center p-1  photos-preview-container">
                <img height="150" src="{{ $path . '/' . $image->filename }}" class="rounded img-fluid img-thumbnail" alt="...">
                <x-wrappers.buttons.button-form
                    method="delete"
                    :route="route('cms.images.delete', ['image' => $image])"
                    class="btn-danger btn-sm preview-image-remove-btn"
                    :id="$image->id"
                    title=""
                >
                    <x-icons.trash />
                </x-wrappers.buttons.button-form>
            </div>
        @empty
            {{ __('cms/common.no_images') }}
        @endforelse
    </div>
</div>
