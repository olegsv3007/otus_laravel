
@props(['organizations'])

<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">{{ __('cms/organizations.titles.id') }}</th>
        <th scope="col">{{ __('cms/organizations.titles.name') }}</th>
        <th scope="col">{{ __('cms/organizations.titles.email') }}</th>
        <th scope="col">{{ __('cms/organizations.titles.phone') }}</th>
    </tr>
    </thead>
    <tbody>
    @forelse($organizations as $organization)
        <x-cms.organizations.row :organization="$organization"></x-cms.organizations.row>
    @empty
        <x-cms.organizations.row-empty></x-cms.organizations.row-empty>
    @endforelse
    </tbody>
</table>
