@extends('layouts.admin')

@section('content')
    <div class="container-fluid p-5">
        <div class="d-flex justify-content-end m-2">
            <x-wrappers.buttons.cms-default-button-link
                class="btn-primary"
                :href="route(\App\Services\Routes\Providers\Cms\CmsRoutes::CMS_ORGANIZATIONS_CREATE, ['locale' => $locale])"
                :title="__('cms/organizations.buttons.add')"
            >
                <x-icons.plus />
            </x-wrappers.buttons.cms-default-button-link>
        </div>
        <h2>{{ __('cms/organizations.headers.index') }}</h2>
        <x-cms.organizations.table :organizations="$organizations" />
        <div class="d-flex justify-content-center">
            {{ $organizations->links('components.paginator.default') }}
        </div>
    </div>
@endsection
