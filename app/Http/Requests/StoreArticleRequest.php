<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // We allow this request
    }

    protected function prepareForValidation(): void
    {
        // Automatically create a slug if it's missing
        $this->merge([
            'slug' => $this->input('slug') ?: Str::slug($this->input('title'))
        ]);
    }

    public function rules(): array
    {
        return [
            'title'   => ['required','string','min:3','max:150'],
            'slug'    => ['required','string','max:180','unique:articles,slug'],
            'content' => ['required','string','min:20'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title is required.',
            'content.min'    => 'The content must be at least :min characters.',
            'slug.unique'    => 'This slug is already used.',
        ];
    }

    public function attributes(): array
    {
        return [
            'title'   => 'title',
            'slug'    => 'slug',
            'content' => 'content',
        ];
    }
}
