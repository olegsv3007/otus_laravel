
@props(['type', 'name', 'value', 'label'])

<div class="form-group">
    <label for="{{ $name }}">{{ $label  }}</label>
    <input
        type="{{ $type }}"
        class="form-control @error($name) {{ 'is-invalid' }} @enderror"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ old($name) ?? $value }}"
    >
    @error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
