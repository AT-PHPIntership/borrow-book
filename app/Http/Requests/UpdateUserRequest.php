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
     * @param Illuminate\Http\Request $request request for edit user
     *
     * @return array
     */
    public function rules(Requests $request)
    {
        return [
            'name'            => 'required|string|max:255',
            'identity_number' => 'required|integer|unique:users,identity_number,'.$request->get('id'),
            'avatar'          => 'image|mimes:png,jpg,jpeg',
            'dob'             => 'date_format:"Y-m-d"',
            'address'         => 'string|max:255',
        ];
    }
}
