
@props(['apartment'])

<tr class="clickable-row" data-href="{{ route(\App\Services\Routes\Providers\Cms\CmsRoutes::CMS_APARTMENTS_EDIT, ['apartment_no_scope' => $apartment, 'locale' => $locale]) }}">
    <th scope="row" class="col-1">{{ $apartment->id }}
    @if($apartment->deleted_at)
            <span class="ml-1 badge badge-pill badge-warning">{{ __('cms/common.deleted') }}</span>
    @endif
    </th>
    <td class="col-1 text-center {{ $apartment->active ? 'text-success' : 'text-danger' }}">
        {{ $apartment->active ? __('cms/common.yes') : __('cms/common.no') }}
    </td>
    <td class="col-3">{{ $apartment->title }}</td>
    <td class="col-2 text-center">{{ $apartment->number_of_rooms }}</td>
    <td class="col-2 text-center">{{ $apartment->price }}</td>
    <td class="col-3">{{ $apartment->hotel->name }}</td>
</tr>
