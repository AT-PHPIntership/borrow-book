<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookRequest extends FormRequest
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
            'category_id'     => 'required|exists:categories,id',
            'title'           => 'required|string|max:255',
            'description'     => 'required|string',
            'number_of_page'  => 'required|integer',
            'author'          => 'required|string|max:255',
            'publishing_year' => 'date_format:"Y-m-d"|before:today',
            'language'        => 'required|string|max:255',
            'quantity'        => 'integer'
        ];
    }
}
