<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTweetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content' => ['required', 'string', 'min:1', 'max:140'],
        ];
    }

    public function messages(): array
    {
        return [
            'content.max' => 'Tweet cannot exceed 140 characters',
        ];
    }
}
