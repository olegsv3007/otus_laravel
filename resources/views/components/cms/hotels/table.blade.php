
@props(['hotels'])

<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">{{ __('cms/hotels.titles.id') }}</th>
        <th scope="col" class="text-center">{{ __('cms/hotels.titles.active') }}</th>
        <th scope="col">{{ __('cms/hotels.titles.name') }}</th>
        <th scope="col">{{ __('cms/hotels.titles.phone') }}</th>
        <th scope="col">{{ __('cms/hotels.titles.email') }}</th>
        <th scope="col">{{ __('cms/hotels.titles.organization') }}</th>
        <th scope="col">{{ __('cms/hotels.titles.city') }}</th>
    </tr>
    </thead>
    <tbody>
    @forelse($hotels as $hotel)
        <x-cms.hotels.row :hotel="$hotel"></x-cms.hotels.row>
    @empty
        <x-cms.hotels.row-empty></x-cms.hotels.row-empty>
    @endforelse
    </tbody>
</table>
