@extends('layouts.profile')

@section('title', __('public/pages/profile.title'))
@section('content')
    <div class="row">
        <div class="col-12 col-md-10 offset-md-1">
            {!! Form::open(['url' => '#', 'method' => 'put', 'class' => 'needs-validation']) !!}
            {!! Form::bsText('name', __('public/pages/profile.form.name_title'), '', ['required' => true]) !!}
            {!! Form::bsText('email', __('public/pages/profile.form.email_title'), '', ['required' => true]) !!}
            {!! Form::bsPassword('password', __('public/pages/profile.form.password_title'), ['autocomplete' => 'new-password']) !!}
            {!! Form::bsPassword('password_confirmation', __('public/pages/profile.form.password_confirmation_title'), ['autocomplete' => 'new-password']) !!}
            {!! Form::bsButton(__('public/pages/profile.form.submit_button_title'), 'submit') !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
