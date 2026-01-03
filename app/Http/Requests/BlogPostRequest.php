<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {


        return [
            'title' => "bail|required|unique:posts,title,{$this->input('id')}",
            'author' => 'required',
            'body' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Please enter a title',
            'author.required' => 'Please enter an author',
            'body.required' => 'Please enter a body'
        ];
    }
}
