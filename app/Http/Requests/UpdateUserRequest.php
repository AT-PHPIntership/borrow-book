<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\User;

class UpdateUserRequest extends FormRequest
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
     * @param Illuminate\Http\Request $request request for edit user
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'name'            => 'required|string|max:255',
            'identity_number' => 'required|integer|unique:users,id,'.$request->get('id'),
            'avatar'          => 'image|mimes:png,jpg,jpeg',
            'dob'             => 'date_format:"Y-m-d"',
            'address'         => 'string|max:255',
        ];
    }
}
