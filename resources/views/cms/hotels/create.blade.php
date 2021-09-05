@extends('layouts.admin')

@section('content')
    <div class="container p-5">
        <h2 class="text-center">{{ __('cms/hotels.headers.create') }}</h2>
        <div class="row justify-content-center">
            <div class="col-8">
                <form
                    action="{{ route(\App\Services\Routes\Providers\Cms\CmsRoutes::CMS_HOTELS_STORE) }}"
                    class="mt-5 needs-validation"
                    novalidate
                    method="post"
                    enctype="multipart/form-data"
                >
                    @csrf
                    @method('post')

                    <x-wrappers.forms.bs-switch
                        name="active"
                        checked=""
                        :label="__('cms/hotels.titles.active')"
                    />

                    <x-wrappers.forms.bs-text
                        name="name"
                        type="text"
                        value=""
                        :label="__('cms/hotels.titles.name')"
                    />

                    <x-wrappers.forms.bs-text
                        name="slug"
                        type="text"
                        value=""
                        :label="__('cms/hotels.titles.slug')"
                    />

                    <x-wrappers.forms.bs-model-select
                        :service="App\Services\Cms\Organizations\OrganizationService::class"
                        default="1"
                        name="organization_id"
                        :label="__('cms/hotels.titles.organization')"
                    />

                    <x-wrappers.forms.bs-model-select
                        :service="App\Services\Cms\Cities\CityService::class"
                        default="1"
                        name="city_id"
                        :label="__('cms/hotels.titles.city')"
                    />

                    <x-wrappers.forms.bs-text
                        name="phone"
                        type="text"
                        value=""
                        :label="__('cms/hotels.titles.phone')"
                    />

                    <x-wrappers.forms.bs-text
                        name="email"
                        type="email"
                        value=""
                        :label="__('cms/hotels.titles.email')"
                    />

                    <x-wrappers.forms.bs-text
                        name="address"
                        type="text"
                        value=""
                        :label="__('cms/hotels.titles.address')"
                    />

                    <x-wrappers.forms.bs-text
                        name="discount"
                        type="number"
                        value=""
                        :label="__('cms/hotels.titles.discount')"
                    />

                    <div class="form-row mt-3">
                        <x-wrappers.forms.bs-coordinates
                            name="latitude"
                            value="0.00000"
                            :label="__('cms/hotels.titles.latitude')"
                        />

                        <x-wrappers.forms.bs-coordinates
                            name="longitude"
                            value="0.00000"
                            :label="__('cms/hotels.titles.longitude')"
                        />
                    </div>

                    <x-wrappers.forms.bs-file
                        name="main_image"
                        value=""
                        :label="__('cms/hotels.titles.main_image')"
                    />

                    <x-wrappers.forms.bs-button
                        :title="__('cms/hotels.buttons.store')"
                        class="btn-primary float-right mt-5"
                        type="submit"
                    />

                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
@endsection
