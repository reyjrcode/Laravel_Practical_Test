<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TweetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */

    public function rules(): array
    {
        return [
            'title' => 'string|max:255|required',
            'content' => 'string|max:255|required',
            'user_id' => 'string|required',

        ];
    }
    /**
     * Summary of messages
     * @return array
     */
    public function messages()
    {
        return [
            'user_id.required' => 'No user pass data',
            'content.required' => 'Please add a content',
            'title.required' => 'Please add title',

        ];
    }
}