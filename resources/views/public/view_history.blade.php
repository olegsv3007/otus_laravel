@extends('layouts.profile')

@section('title', __('public/pages/view_history.title'))
@section('content')
    <x-view-history.block />
    <x-paginator.block />
@endsection
