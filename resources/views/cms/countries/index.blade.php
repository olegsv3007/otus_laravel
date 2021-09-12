@extends('layouts.admin')

@section('content')
    <div class="container-fluid p-5">
        <div class="d-flex justify-content-end m-2">
            <x-wrappers.buttons.cms-default-button-link
                class="btn-primary"
                :href="route(\App\Services\Routes\Providers\Cms\CmsRoutes::CMS_COUNTRIES_CREATE)"
                :title="__('cms/countries.buttons.add')"
            >
                <x-icons.plus />
            </x-wrappers.buttons.cms-default-button-link>
        </div>
        <h2>{{ __('cms/countries.headers.index') }}</h2>
        <x-cms.countries.table :countries="$countries" />
        <div class="d-flex justify-content-center">
            {{ $countries->links('components.paginator.default') }}
        </div>
    </div>
@endsection
