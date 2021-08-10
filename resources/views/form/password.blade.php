<div class="col-12 mb-3">
    {{ Form::label($name, $title) }}
    {{ Form::password($name, array_merge(['class' => ['form-control', $errors->first($name) ? 'is-invalid' : '']], $attributes)) }}
    @error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
