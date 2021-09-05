<?php

namespace App\Http\Controllers\Cms\Apartments\Requests;

class UpdateApartmentRequest extends StoreApartmentRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = parent::rules();
        $rules['main_image'] = [
            'mimes:jpeg,jpg,png',
            'between:0,2048',
            'dimensions:min_width=96,min_height=96,max_width=4096,max_height=4096',
        ];

        $rules['images'] = [

        ];

        return $rules;
    }
}
