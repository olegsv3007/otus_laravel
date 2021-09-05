
@props(['cities'])

<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">{{ __('cms/cities.titles.id') }}</th>
        <th scope="col">{{ __('cms/cities.titles.name') }}</th>
        <th scope="col">{{ __('cms/cities.titles.country') }}</th>
    </tr>
    </thead>
    <tbody>
    @forelse($cities as $city)
        <x-cms.cities.row :city="$city"></x-cms.cities.row>
    @empty
        <x-cms.cities.row-empty></x-cms.cities.row-empty>
    @endforelse
    </tbody>
</table>
