@extends('layouts.admin')

@section('content')
    <div class="container p-5">
        <h2 class="text-center">{{ __('cms/hotels.headers.edit') }}</h2>
        <div class="row justify-content-center">
            <div class="col-8">
                @if (!$hotel->deleted_at)
                <x-wrappers.buttons.button-form
                    method="delete"
                    class="btn-danger float-right"
                    :route="route(\App\Services\Routes\Providers\Cms\CmsRoutes::CMS_HOTELS_DESTROY, ['hotel_no_scope' => $hotel])"
                    :title="__('cms/hotels.buttons.delete')"
                    :id="$hotel->id"
                />
                @else
                <x-wrappers.buttons.button-form
                    method="patch"
                    class="btn-warning float-right"
                    :route="route(\App\Services\Routes\Providers\Cms\CmsRoutes::CMS_HOTELS_RESTORE, ['hotel_no_scope' => $hotel])"
                    :title="__('cms/hotels.buttons.restore')"
                    :id="$hotel->id"
                />
                @endif
                <form
                    action="{{ route(\App\Services\Routes\Providers\Cms\CmsRoutes::CMS_HOTELS_UPDATE, ['hotel_no_scope' => $hotel]) }}"
                    class="mt-5 needs-validation"
                    novalidate
                    method="post"
                    enctype="multipart/form-data"
                >
                    @csrf
                    @method('put')

                    <x-wrappers.forms.bs-switch
                        name="active"
                        :checked="$hotel->active"
                        :label="__('cms/hotels.titles.active')"
                    />

                    <x-wrappers.forms.bs-text
                        name="name"
                        type="text"
                        :value="$hotel->name"
                        :label="__('cms/hotels.titles.name')"
                    />

                    <x-wrappers.forms.bs-text
                        name="slug"
                        type="text"
                        :value="$hotel->slug"
                        :label="__('cms/hotels.titles.slug')"
                    />

                    <x-wrappers.forms.bs-model-select
                        :service="App\Services\Cms\Organizations\OrganizationService::class"
                        :default="$hotel->organization_id"
                        name="organization_id"
                        :label="__('cms/hotels.titles.organization')"
                    />

                    <x-wrappers.forms.bs-model-select
                        :service="App\Services\Cms\Cities\CityService::class"
                        :default="$hotel->city_id"
                        name="city_id"
                        :label="__('cms/hotels.titles.city')"
                    />

                    <x-wrappers.forms.bs-text
                        name="phone"
                        type="text"
                        :value="$hotel->phone"
                        :label="__('cms/hotels.titles.phone')"
                    />

                    <x-wrappers.forms.bs-text
                        name="email"
                        type="email"
                        :value="$hotel->email"
                        :label="__('cms/hotels.titles.email')"
                    />

                    <x-wrappers.forms.bs-text
                        name="address"
                        type="text"
                        :value="$hotel->address"
                        :label="__('cms/hotels.titles.address')"
                    />

                    <x-wrappers.forms.bs-text
                        name="discount"
                        type="number"
                        :value="$hotel->discount"
                        :label="__('cms/hotels.titles.discount')"
                    />

                    <div class="form-row mt-3">
                        <x-wrappers.forms.bs-coordinates
                            name="latitude"
                            :value="$hotel->latitude"
                            :label="__('cms/hotels.titles.latitude')"
                        />

                        <x-wrappers.forms.bs-coordinates
                            name="longitude"
                            :value="$hotel->longitude"
                            :label="__('cms/hotels.titles.longitude')"
                        />
                    </div>

                    <x-wrappers.forms.bs-file
                        name="main_image"
                        :label="__('cms/hotels.titles.main_image')"
                    />

                    <x-wrappers.forms.photo-preview
                        :title="__('cms/hotels.titles.main_image_active')"
                        :src="$hotel->mainImageSrc"
                    />

                    <x-wrappers.forms.bs-button
                        :title="__('cms/hotels.buttons.update')"
                        class="btn-primary float-right mt-5"
                        type="submit"
                    />
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
@endsection
