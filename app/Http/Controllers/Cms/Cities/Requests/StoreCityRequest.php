<?php

namespace App\Http\Controllers\Cms\Cities\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class StoreCityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
            ],
            'country_id' => [
                'required',
                'exists:countries,id',
            ],
            'latitude' => [
                'required',
                'numeric',
                'between:-90.0,90.0',
            ],
            'longitude' => [
                'required',
                'numeric',
                'between:-180.0,180.0',
            ],
        ];
    }

   public function messages(): array
    {
        return [
            'country_id.exists' => __('validation.country_is_not_exists'),
            'latitude.digits_between' => __('validation.latitude_between'),
            'longitude.digits_between' => __('validation.longitude_between'),
        ];
    }
}
