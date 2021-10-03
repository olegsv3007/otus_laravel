
@props(['city'])

<tr class="clickable-row" data-href="{{ route(\App\Services\Routes\Providers\Cms\CmsRoutes::CMS_CITIES_EDIT, ['city_no_scope' => $city, 'locale' => $locale]) }}">
    <th scope="row" class="col-1">{{ $city->id }}
    @if($city->deleted_at)
        <span class="ml-1 badge badge-pill badge-warning">{{ __('cms/common.deleted') }}</span>
    @endif
    </th>
    <td class="col-5">{{ $city->name }}</td>
    <td class="col-5">{{ $city->country->name }}</td>
</tr>
