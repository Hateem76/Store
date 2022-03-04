<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'category' => 'required',
            'image_path' => 'mimes:jpg,png,jpeg|max:512',
            'brand_name' => 'max:20',
            'weight' => 'min:0',
            'description' => 'max:50',
            'rent_day' => 'min:0',
            'rent_week' => 'min:0',
            'rent_month' => 'min:0',
        ];
    }
}
