<?php

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateRequest extends FormRequest
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
            'news_id' => ['required', 'integer', 'exists:news,id'],
            'comment' => ['required', 'string', 'max:255'],
            // 'user_id' => ['integer', 'exists:users,id'],
        ];
    }

    //message
    public function messages()
    {
        return [
            'news_id.required' => 'A news_id is required',
            'news_id.integer' => 'News_id must be a integer',
            'comment.required' => 'A comment is required',
            'comment.string' => 'Comment must be a string',
            'comment.max' => 'Comment must be less than 255 characters',
        ];
    }
}
