<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class CreateUserRequest extends FormRequest
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
            'name'            => 'required|string|max:255',
            'email'           => 'required|string|email|max:255|unique:users',
            'identity_number' => 'required|integer|unique:users',
            'avatar'          => 'image|mimes:png,jpg,jpeg',
            'dob'             => 'date_format:"Y-m-d"',
            'address'         => 'string|max:255',
            'role'            => 'in:' . User::ROLE_USER . ','
                                       . User::ROLE_ADMIN
        ];
    }
}
