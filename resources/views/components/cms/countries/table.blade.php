
@props(['countries'])

<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">{{ __('cms/countries.titles.id') }}</th>
        <th scope="col">{{ __('cms/countries.titles.name') }}</th>
    </tr>
    </thead>
    <tbody>
    @forelse($countries as $country)
        <x-cms.countries.row :country="$country"></x-cms.countries.row>
    @empty
        <x-cms.countries.row-empty></x-cms.countries.row-empty>
    @endforelse
    </tbody>
</table>
