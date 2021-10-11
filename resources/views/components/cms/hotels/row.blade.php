
@props(['hotel'])

<tr class="clickable-row" data-href="{{ route(\App\Services\Routes\Providers\Cms\CmsRoutes::CMS_HOTELS_EDIT, ['hotel_no_scope' => $hotel, 'locale' => $locale]) }}">
    <th scope="row" class="col-1">{{ $hotel->id }}
    @if($hotel->deleted_at)
        <span class="ml-1 badge badge-pill badge-warning">{{ __('cms/common.deleted') }}</span>
    @endif
    </th>
    <td class="col-1 text-center {{ $hotel->active ? 'text-success' : 'text-danger' }}">
        {{ $hotel->active ? __('cms/common.yes') : __('cms/common.no') }}
    </td>
    <td class="col-2">{{ $hotel->name }}</td>
    <td class="col-2">{{ $hotel->phone }}</td>
    <td class="col-2">{{ $hotel->email }}</td>
    <td class="col-2">{{ $hotel->organization->name }}</td>
    <td class="col-2">{{ $hotel->city->name }}</td>
</tr>
