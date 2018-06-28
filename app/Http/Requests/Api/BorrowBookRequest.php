<?php

namespace App\Http\Requests\Api;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Book;

class BorrowBookRequest extends FormRequest
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
        $index = 0;
        $rules = [];
        foreach (request('book') as $input) {
            $book = Book::find($input['id']);
            $rules['book.'.$index.'.quantity'] = 'numeric|max:'.$book->quantity;
            $index++;
        }
        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        $index = 0;
        $messages = [];
        foreach (request('book') as $input) {
            $book = Book::find($input['id']);
            $messages['book.'.$index.'.quantity.max'] = 'The quantity Book '.$book->title.' must be less than :max.';
            $index++;
        }
        return $messages;
    }
}
