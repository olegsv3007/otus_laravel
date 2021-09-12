@extends('layouts.admin')

@section('content')
    <div class="container p-5">
        <h2 class="text-center">{{ __('cms/countries.headers.edit') }}</h2>
        <div class="row justify-content-center">
            <div class="col-8">
                @if (!$country->deleted_at)
                <x-wrappers.buttons.button-form
                    method="delete"
                    class="btn-danger float-right"
                    :route="route(\App\Services\Routes\Providers\Cms\CmsRoutes::CMS_COUNTRIES_DESTROY, ['country_no_scope' => $country])"
                    :title="__('cms/countries.buttons.delete')"
                    id="remove_country_{{ $country->id }}"
                />
                @else
                <x-wrappers.buttons.button-form
                    method="patch"
                    class="btn-warning float-right"
                    :route="route(\App\Services\Routes\Providers\Cms\CmsRoutes::CMS_COUNTRIES_RESTORE, ['country_no_scope' => $country])"
                    :title="__('cms/countries.buttons.restore')"
                    id="restore_country_{{ $country->id }}"
                />
                @endif
                <form action="{{ route(\App\Services\Routes\Providers\Cms\CmsRoutes::CMS_COUNTRIES_UPDATE, ['country_no_scope' => $country]) }}" class="mt-5 needs-validation" novalidate method="post">
                    @csrf
                    @method('put')
                    <x-wrappers.forms.bs-text
                        name="name"
                        type="text"
                        :value="$country->name"
                        :label="__('cms/countries.titles.name')"
                    />
                    <x-wrappers.forms.bs-button
                        :title="__('cms/countries.buttons.update')"
                        class="btn-primary float-right"
                        type="submit"
                    />
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
@endsection
