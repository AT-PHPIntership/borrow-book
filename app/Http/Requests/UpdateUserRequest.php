<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'            => 'required|string|max:255',
            'email'           => 'required|string|email|max:255|unique:users',
            'identity_number' => 'required|integer|unique:users|max:9',
            'avatar'          => 'image|mimes:png,jpg,jpeg',
            'dob'             => 'date_format:"Y-m-d"',
            'address'         => 'string|max:255',
        ];
    }
}
