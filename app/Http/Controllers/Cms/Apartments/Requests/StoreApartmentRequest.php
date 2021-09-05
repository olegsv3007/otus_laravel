<?php

namespace App\Http\Controllers\Cms\Apartments\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class StoreApartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'active' => '',
            'title' => 'required',
            'hotel_id' => [
                'required',
                'exists:hotels,id',
            ],
            'number_of_rooms' => [
                'required',
                'integer',
                'min:1',
            ],
            'description' => [
                'required',
                'max:1000'
            ],
            'price' => [
                'required',
                'numeric',
                'min:1',
            ],
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
            ],
            'images' => ['required'],
            'images.*' => [
                'mimes:jpeg,jpg,png',
                'between:0,2048',
                'dimensions:min_width=96,min_height=96,max_width=4096,max_height=4096',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'hotel_id.exists' => __('validation.hotel_is_not_exists'),
        ];
    }
}
