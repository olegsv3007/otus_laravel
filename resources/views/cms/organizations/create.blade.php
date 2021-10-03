@extends('layouts.admin')

@section('content')
    <div class="container p-5">
        <h2 class="text-center">{{ __('cms/organizations.headers.create') }}</h2>
        <div class="row justify-content-center">
            <div class="col-8">
                <form action="{{ route(\App\Services\Routes\Providers\Cms\CmsRoutes::CMS_ORGANIZATIONS_STORE, ['locale' => $locale]) }}" class="mt-5 needs-validation" novalidate method="post">
                    @csrf
                    @method('post')

                    <x-wrappers.forms.bs-text
                        name="name"
                        type="text"
                        value=""
                        :label="__('cms/organizations.titles.name')"
                    />

                    <x-wrappers.forms.bs-text
                        name="slug"
                        type="text"
                        value=""
                        :label="__('cms/organizations.titles.slug')"
                    />

                    <x-wrappers.forms.bs-text
                        name="phone"
                        type="text"
                        value=""
                        :label="__('cms/organizations.titles.phone')"
                    />

                    <x-wrappers.forms.bs-text
                        name="email"
                        type="email"
                        value=""
                        :label="__('cms/organizations.titles.email')"
                    />

                    <x-wrappers.forms.bs-button
                        :title="__('cms/organizations.buttons.store')"
                        class="btn-primary float-right"
                        type="submit"
                    />

                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
@endsection
