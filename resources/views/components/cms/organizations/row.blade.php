
@props(['organization'])

<tr class="clickable-row" data-href="{{ route(\App\Services\Routes\Providers\Cms\CmsRoutes::CMS_ORGANIZATIONS_EDIT, ['organization_no_scope' => $organization]) }}">
    <th scope="row" class="col-1">{{ $organization->id }}
        @if($organization->deleted_at)
            <span class="ml-1 badge badge-pill badge-warning">{{ __('cms/common.deleted') }}</span>
        @endif
    </th>
    <td class="col-3">{{ $organization->name }}</td>
    <td class="col-3">{{ $organization->email }}</td>
    <td class="col-3">{{ $organization->phone }}</td>
</tr>
