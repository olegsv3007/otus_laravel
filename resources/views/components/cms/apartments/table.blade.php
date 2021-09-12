
@props(['apartments'])

<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">{{ __('cms/apartments.titles.id') }}</th>
        <th scope="col" class="text-center">{{ __('cms/apartments.titles.active') }}</th>
        <th scope="col">{{ __('cms/apartments.titles.title') }}</th>
        <th scope="col" class="text-center">{{ __('cms/apartments.titles.number_of_rooms') }}</th>
        <th scope="col" class="text-center">{{ __('cms/apartments.titles.price') }}</th>
        <th scope="col">{{ __('cms/apartments.titles.hotel') }}</th>
    </tr>
    </thead>
    <tbody>
    @forelse($apartments as $apartment)
        <x-cms.apartments.row :apartment="$apartment" />
    @empty
        <x-cms.apartments.row-empty />
    @endforelse
    </tbody>
</table>
