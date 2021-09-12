
@props(['name', 'value', 'label', 'rows'])

<div class="form-group">
    <label for="{{ $name }}">{{ $label  }}</label>
    <textarea
        class="form-control @error($name) {{ 'is-invalid' }} @enderror"
        id="{{ $name }}"
        name="{{ $name }}"
        rows="{{ $rows }}"
    >{{ old($name) ?? $value }}</textarea>
    @error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
