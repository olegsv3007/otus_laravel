@extends('layouts.admin')

@section('content')
    <div class="container p-5">
        <h2 class="text-center">{{ __('cms/organizations.headers.edit') }}</h2>
        <div class="row justify-content-center">
            <div class="col-8">
                @if (!$organization->deleted_at)
                <x-wrappers.buttons.button-form
                    method="delete"
                    class="btn-danger float-right"
                    :route="route(\App\Services\Routes\Providers\Cms\CmsRoutes::CMS_ORGANIZATIONS_DESTROY, ['organization_no_scope' => $organization])"
                    :title="__('cms/organizations.buttons.delete')"
                    id="remove_organization_{{ $organization->id }}"
                />
                @else
                <x-wrappers.buttons.button-form
                    method="patch"
                    class="btn-warning float-right"
                    :route="route(\App\Services\Routes\Providers\Cms\CmsRoutes::CMS_ORGANIZATIONS_RESTORE, ['organization_no_scope' => $organization])"
                    :title="__('cms/organizations.buttons.restore')"
                    id="restore_organization_{{ $organization->id }}"
                />
                @endif
                <form action="{{ route(\App\Services\Routes\Providers\Cms\CmsRoutes::CMS_ORGANIZATIONS_UPDATE, ['organization_no_scope' => $organization]) }}" class="mt-5 needs-validation" novalidate method="post">
                    @csrf
                    @method('put')

                    <x-wrappers.forms.bs-text
                        name="name"
                        type="text"
                        :value="$organization->name"
                        :label="__('cms/organizations.titles.name')"
                    />

                    <x-wrappers.forms.bs-text
                        name="slug"
                        type="text"
                        :value="$organization->slug"
                        :label="__('cms/organizations.titles.slug')"
                    />

                    <x-wrappers.forms.bs-text
                        name="phone"
                        type="text"
                        :value="$organization->phone"
                        :label="__('cms/organizations.titles.phone')"
                    />

                    <x-wrappers.forms.bs-text
                        name="email"
                        type="email"
                        :value="$organization->email"
                        :label="__('cms/organizations.titles.email')"
                    />

                    <x-wrappers.forms.bs-button
                        :title="__('cms/organizations.buttons.update')"
                        class="btn-primary float-right"
                        type="submit"
                    />
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
@endsection
