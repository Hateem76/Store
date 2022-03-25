<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TenderResponseRequest extends FormRequest
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
            'name'  => 'required',
            'quotation' => 'mimes:pdf,docx|max:1024|required_without:link',
            'link' => 'required_without:quotation|max:60',
            'price'   => 'required',
            'description' => 'max:290',
        ];
    }
}
