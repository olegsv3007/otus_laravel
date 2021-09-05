
@props(['name', 'value', 'label'])

<div class="form-group col-md-6">
    <label for="{{ $name }}">{{ $label  }}</label>
    <input
        type="number"
        class="form-control @error($name) {{ 'is-invalid' }} @enderror"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ $value }}"
        step="0.000001"
    >
    @error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
