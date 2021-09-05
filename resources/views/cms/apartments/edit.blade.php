@extends('layouts.admin')

@section('content')
    <div class="container p-5">
        <h2 class="text-center">{{ __('cms/apartments.headers.edit') }}</h2>
        <div class="row justify-content-center">
            <div class="col-8">
                @if (!$apartment->deleted_at)
                <x-wrappers.buttons.button-form
                    method="delete"
                    class="btn-danger float-right"
                    :route="route(\App\Services\Routes\Providers\Cms\CmsRoutes::CMS_APARTMENTS_DESTROY, ['apartment_no_scope' => $apartment])"
                    :title="__('cms/apartments.buttons.delete')"
                    :id="$apartment->id"
                />
                @else
                <x-wrappers.buttons.button-form
                    method="patch"
                    class="btn-warning float-right"
                    :route="route(\App\Services\Routes\Providers\Cms\CmsRoutes::CMS_APARTMENTS_RESTORE, ['apartment_no_scope' => $apartment])"
                    :title="__('cms/apartments.buttons.restore')"
                    :id="$apartment->id"
                />
                @endif
                <form
                    action="{{ route(\App\Services\Routes\Providers\Cms\CmsRoutes::CMS_APARTMENTS_UPDATE, ['apartment_no_scope' => $apartment]) }}"
                    class="mt-5 needs-validation"
                    novalidate
                    method="post"
                    enctype="multipart/form-data"
                    id="main_form"
                >
                    @csrf
                    @method('put')

                    <x-wrappers.forms.bs-switch
                        name="active"
                        :checked="$apartment->active"
                        :label="__('cms/apartments.titles.active')"
                    />

                    <x-wrappers.forms.bs-text
                        name="title"
                        type="text"
                        :value="$apartment->title"
                        :label="__('cms/apartments.titles.title')"
                    />

                    <x-wrappers.forms.bs-model-select
                        :service="App\Services\Cms\Hotels\HotelService::class"
                        :default="$apartment->hotel_id"
                        name="hotel_id"
                        :label="__('cms/apartments.titles.hotel')"
                    />

                    <x-wrappers.forms.bs-text
                        name="number_of_rooms"
                        type="number"
                        :value="$apartment->number_of_rooms"
                        :label="__('cms/apartments.titles.number_of_rooms')"
                    />

                    <x-wrappers.forms.bs-text-area
                        name="description"
                        :value="$apartment->description"
                        rows="5"
                        :label="__('cms/apartments.titles.description')"
                    />

                    <x-wrappers.forms.bs-price
                        name="price"
                        :value="$apartment->price"
                        :label="__('cms/apartments.titles.price')"
                    />

                    <x-wrappers.forms.bs-text
                        name="discount"
                        type="number"
                        :value="$apartment->discount"
                        :label="__('cms/apartments.titles.discount')"
                    />

                    <x-wrappers.forms.bs-file
                        name="main_image"
                        :label="__('cms/apartments.titles.main_image')"
                    />

                    <x-wrappers.forms.photo-preview
                        :title="__('cms/apartments.titles.main_image_active')"
                        :src="$apartment->mainImageSrc"
                    />

                    <x-wrappers.forms.bs-files
                        name="images"
                        :label="__('cms/apartments.titles.images')"
                    />
                    <div class="clearfix"></div>
                </form>
                <x-wrappers.forms.photos-preview
                    :title="__('cms/apartments.titles.current_images')"
                    :images="$apartment->images"
                    path="{{ '/img/' . \App\Models\Apartment::FOLDER_PHOTOS }}"
                />
                <x-wrappers.forms.bs-button
                    :title="__('cms/apartments.buttons.update')"
                    class="btn-primary float-right mt-5"
                    type="submit"
                    form="main_form"
                />
            </div>
        </div>
    </div>
@endsection
