<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
        switch ($this->method()){
            case 'POST':
                return [
                    'name' => 'required|max:255',
                    'email' => 'required|max:255|unique:users',
                    'password' => 'required|max:255|min:8'
                ]; 
                break;

            case 'PATCH':
            case 'PUT':
                return [
                    'name' => 'required|max:255',
                    'email' => 'required|max:255',   // unique:users,email,'.$this->user->id,
                    'password' => 'required|max:255|min:8'
                ]; 
                break;

        }
        // if($this->user){
        //     return [
        //         'name' => 'required|max:255',
        //         'email' => 'required|max:255|unique:users,email,'.$this->id,
        //         'password' => 'required|max:255|min:8'
        //     ];
        // }
        // return [
        //     'name' => 'required|max:255',
        //     'email' => 'required|max:255|unique:users',
        //     'password' => 'required|max:255|min:8'
        // ];
    }
}
