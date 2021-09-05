@extends('layouts.admin')

@section('content')
    <div class="container-fluid p-5">
        <div class="d-flex justify-content-end m-2">
            <x-wrappers.buttons.cms-default-button-link
                class="btn-primary"
                :href="route(\App\Services\Routes\Providers\Cms\CmsRoutes::CMS_HOTELS_CREATE)"
                :title="__('cms/hotels.buttons.add')"
            >
                <x-icons.plus />
            </x-wrappers.buttons.cms-default-button-link>
        </div>
        <h2>{{ __('cms/hotels.headers.index') }}</h2>
        <x-cms.hotels.table :hotels="$hotels" />
        <div class="d-flex justify-content-center">
            {{ $hotels->links('components.paginator.default') }}
        </div>
    </div>
@endsection
