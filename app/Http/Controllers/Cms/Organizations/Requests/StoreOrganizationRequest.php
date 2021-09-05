<?php

namespace App\Http\Controllers\Cms\Organizations\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrganizationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $organization_id = $this
            ->route()
            ->parameter('organization_no_scope')
            ?->id;

        return [
            'name' => 'required',
            'slug' => [
                'required',
                'unique:organizations,slug,' . $organization_id ?? '',
            ],
            'phone' => 'required',
            'email' => [
                'required',
                'email',
            ],
        ];
    }
}
