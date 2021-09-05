@extends('layouts.admin')

@section('content')
    <div class="container p-5">
        <h2 class="text-center">{{ __('cms/cities.headers.create') }}</h2>
        <div class="row justify-content-center">
            <div class="col-8">
                <form action="{{ route(\App\Services\Routes\Providers\Cms\CmsRoutes::CMS_CITIES_STORE) }}" class="mt-5 needs-validation" novalidate method="post">
                    @csrf
                    @method('post')
                    <x-wrappers.forms.bs-text
                        name="name"
                        type="text"
                        value=""
                        :label="__('cms/cities.titles.name')"
                    />

                    <x-wrappers.forms.bs-model-select
                        :service="App\Services\Cms\Countries\CountryService::class"
                        default="1"
                        name="country_id"
                        :label="__('cms/cities.titles.country')"
                    />

                    <div class="form-row mt-3">
                        <x-wrappers.forms.bs-coordinates
                            name="latitude"
                            value="0.00000"
                            :label="__('cms/cities.titles.latitude')"
                        />

                        <x-wrappers.forms.bs-coordinates
                            name="longitude"
                            value="0.00000"
                            :label="__('cms/cities.titles.longitude')"
                        />
                    </div>

                    <x-wrappers.forms.bs-button
                        :title="__('cms/cities.buttons.store')"
                        class="btn-primary float-right mt-3"
                        type="submit"
                    />
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
@endsection
