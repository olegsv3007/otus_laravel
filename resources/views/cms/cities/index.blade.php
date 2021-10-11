@extends('layouts.admin')

@section('content')
    <div class="container-fluid p-5">
        <div class="d-flex justify-content-end m-2">
            <x-wrappers.buttons.cms-default-button-link
                class="btn-primary"
                :href="route(\App\Services\Routes\Providers\Cms\CmsRoutes::CMS_CITIES_CREATE, ['locale' => $locale])"
                :title="__('cms/cities.buttons.add')"
            >
                <x-icons.plus />
            </x-wrappers.buttons.cms-default-button-link>
        </div>
        <h2>{{ __('cms/cities.headers.index') }}</h2>
        <x-cms.cities.table :cities="$cities" />
        <div class="d-flex justify-content-center">
            {{ $cities->links('components.paginator.default') }}
        </div>
    </div>
@endsection
