
@props(['name', 'label', 'checked'])

<div class="custom-control custom-switch mb-3">
    <input type="hidden" name="active" value="0">
    <input
        name="{{ $name }}"
        type="checkbox"
        class="custom-control-input"
        id="{{ $name }}"
        {{ $checked ? 'checked' : '' }}
        value="1"
    >
    <label class="custom-control-label" for="{{ $name }}">{{ $label }}</label>
</div>
