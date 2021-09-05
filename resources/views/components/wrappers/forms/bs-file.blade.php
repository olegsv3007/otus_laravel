
@props(['name', 'label'])

<div class="custom-file mt-3">
    <input
        type="file"
        class="custom-file-input @error($name) {{ 'is-invalid' }} @enderror"
        id="{{ $name }}"
        name="{{ $name }}"
    >
    <label class="custom-file-label" for="{{ $name }}">{{ $label }}</label>

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
