@extends('layouts.admin')

@section('content')
    <div class="container p-5">
        <h2 class="text-center">{{ __('cms/countries.headers.create') }}</h2>
        <div class="row justify-content-center">
            <div class="col-8">
                <form action="{{ route(\App\Services\Routes\Providers\Cms\CmsRoutes::CMS_COUNTRIES_STORE, ['locale' => $locale]) }}" class="mt-5 needs-validation" novalidate method="post">
                    @csrf
                    @method('post')
                    <x-wrappers.forms.bs-text
                        name="name"
                        type="text"
                        value=""
                        :label="__('cms/countries.titles.name')"
                    />
                    <x-wrappers.forms.bs-button
                        :title="__('cms/countries.buttons.store')"
                        class="btn-primary float-right"
                        type="submit"
                    />
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
@endsection
