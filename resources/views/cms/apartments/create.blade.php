@extends('layouts.admin')

@section('content')
    <div class="container p-5">
        <h2 class="text-center">{{ __('cms/apartments.headers.create') }}</h2>
        <div class="row justify-content-center">
            <div class="col-8">
                <form
                    action="{{ route(\App\Services\Routes\Providers\Cms\CmsRoutes::CMS_APARTMENTS_STORE, ['locale' => $locale]) }}"
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
                        :label="__('cms/apartments.titles.active')"
                    />

                    <x-wrappers.forms.bs-text
                        name="title"
                        type="text"
                        value=""
                        :label="__('cms/apartments.titles.title')"
                    />

                    <x-wrappers.forms.bs-model-select
                        :service="App\Services\Cms\Hotels\HotelService::class"
                        default="1"
                        name="hotel_id"
                        :label="__('cms/apartments.titles.hotel')"
                    />

                    <x-wrappers.forms.bs-text
                        name="number_of_rooms"
                        type="number"
                        value=""
                        :label="__('cms/apartments.titles.number_of_rooms')"
                    />

                    <x-wrappers.forms.bs-text-area
                        name="description"
                        value=""
                        rows="5"
                        :label="__('cms/apartments.titles.description')"
                    />

                    <x-wrappers.forms.bs-price
                        name="price"
                        value=""
                        :label="__('cms/apartments.titles.price')"
                    />

                    <x-wrappers.forms.bs-text
                        name="discount"
                        type="number"
                        value=""
                        :label="__('cms/apartments.titles.discount')"
                    />

                    <x-wrappers.forms.bs-file
                        name="main_image"
                        value=""
                        :label="__('cms/apartments.titles.main_image')"
                    />

                    <x-wrappers.forms.bs-files
                        name="images"
                        :label="__('cms/apartments.titles.images')"
                    />

                    <x-wrappers.forms.bs-button
                        :title="__('cms/apartments.buttons.store')"
                        class="btn-primary float-right mt-5"
                        type="submit"
                    />

                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
@endsection
