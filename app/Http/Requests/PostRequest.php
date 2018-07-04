<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Post;

class PostRequest extends FormRequest
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
            'post_type' => 'in:' . Post::COMMENT . ',' . Post::REVIEW,
            'rate_point' => ($this->post_type == Post::REVIEW) ? 'required|integer|min:1|max:5' : "",
            'body' => 'required|string',
        ];
    }
}
