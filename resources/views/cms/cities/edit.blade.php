@extends('layouts.admin')

@section('content')
    <div class="container p-5">
        <h2 class="text-center">{{ __('cms/cities.headers.edit') }}</h2>
        <div class="row justify-content-center">
            <div class="col-8">
                @if (!$city->deleted_at)
                <x-wrappers.buttons.button-form
                    method="delete"
                    class="btn-danger float-right"
                    :route="route(\App\Services\Routes\Providers\Cms\CmsRoutes::CMS_CITIES_DESTROY, ['city_no_scope' => $city, 'locale' => $locale])"
                    :title="__('cms/cities.buttons.delete')"
                    id="remove_city_{{ $city->id }}"
                />
                @else
                <x-wrappers.buttons.button-form
                    method="patch"
                    class="btn-warning float-right"
                    :route="route(\App\Services\Routes\Providers\Cms\CmsRoutes::CMS_CITIES_RESTORE, ['city_no_scope' => $city, 'locale' => $locale])"
                    :title="__('cms/cities.buttons.restore')"
                    id="restore_city_{{ $city->id }}"
                />
                @endif
                <form action="{{ route(\App\Services\Routes\Providers\Cms\CmsRoutes::CMS_CITIES_UPDATE, ['city_no_scope' => $city, 'locale' => $locale]) }}" class="mt-5 needs-validation" novalidate method="post">
                    @csrf
                    @method('PUT')
                    <x-wrappers.forms.bs-text
                        name="name"
                        type="text"
                        :value="$city->name"
                        :label="__('cms/cities.titles.name')"
                    />

                    <x-wrappers.forms.bs-model-select
                        :service="App\Services\Cms\Countries\CountryService::class"
                        :default="$city->country()->withTrashed()->first()->id"
                        name="country_id"
                        :label="__('cms/cities.titles.country')"
                    />

                    <div class="form-row mt-3">
                        <x-wrappers.forms.bs-coordinates
                            name="latitude"
                            :value="$city->latitude"
                            :label="__('cms/cities.titles.latitude')"
                        />

                        <x-wrappers.forms.bs-coordinates
                            name="longitude"
                            :value="$city->longitude"
                            :label="__('cms/cities.titles.longitude')"
                        />
                    </div>

                    <x-wrappers.forms.bs-button
                        :title="__('cms/cities.buttons.update')"
                        class="btn-primary float-right mt-3"
                        type="submit"
                    />
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
@endsection
