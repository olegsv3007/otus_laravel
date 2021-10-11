
@props(['country'])

<tr class="clickable-row" data-href="{{ route(\App\Services\Routes\Providers\Cms\CmsRoutes::CMS_COUNTRIES_EDIT, ['country_no_scope' => $country, 'locale' => $locale]) }}">
    <th scope="row" class="col-1">{{ $country->id }}
    @if($country->deleted_at)
        <span class="ml-1 badge badge-pill badge-warning">{{ __('cms/common.deleted') }}</span>
    @endif
    </th>
    <td class="col">{{ $country->name }}</td>
</tr>
