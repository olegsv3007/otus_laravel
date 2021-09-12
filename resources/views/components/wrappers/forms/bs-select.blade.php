
@props(['items', 'default', 'name', 'label'])
<div class="form-group">
    <label for="inputState">{{ $label }}</label>
    <select name="{{ $name }}" class="form-control
        @error($name)
        {{ 'is-invalid' }}
        @enderror"
    >
        @foreach($items as $item)
        <option value="{{ $item->id }}" {{ $default == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
        @endforeach
    </select>
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
