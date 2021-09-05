
@props(['name', 'value', 'label'])

<div class="form-group">
    <label for="{{ $name }}">{{ $label  }}</label>
    <input
        type="number"
        class="form-control @error($name) {{ 'is-invalid' }} @enderror"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ $value }}"
        min="0"
        step="0.01"
    >
    @error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
