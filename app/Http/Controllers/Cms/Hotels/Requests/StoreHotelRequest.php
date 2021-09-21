<?php

namespace App\Http\Controllers\Cms\Hotels\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHotelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $hotel_id = $this
            ->route()
            ->parameter('hotel_no_scope')
            ?->id;

        return [
            'active' => '',
            'name' => 'required',
            'city_id' => [
                'required',
                'exists:cities,id',
            ],
            'slug' => [
                'required',
                'unique:hotels,slug,' . $hotel_id ?? '',
            ],
            'phone' => 'required',
            'email' => [
                'required',
                'email',
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
            'address' => 'required',
            'discount' => [
                'integer',
                'min:0',
                'max:99',
            ],
            'main_image' => [
                'required',
                'mimes:jpeg,jpg,png',
                'between:0,2048',
                'dimensions:min_width=96,min_height=96,max_width=4096,max_height=4096',
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'city_id.exists' => __('validation.city_is_not_exists'),
            'latitude.digits_between' => __('validation.latitude_between'),
            'longitude.digits_between' => __('validation.longitude_between'),
        ];
    }
}
