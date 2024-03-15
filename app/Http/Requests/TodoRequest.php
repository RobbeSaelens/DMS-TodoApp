<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        // Determine the request method
        $method = $this->method();

        // Define rules for different request methods
        $rules = [
            'title' => ['required', 'max:50', 'regex:/^[a-zA-Z\s]+$/'],
            'description' => 'required',
        ];

        // For PUT requests, allow the title and description fields to be nullable
        if ($method === 'PUT') {
            $rules['title'] = 'nullable|max:50|regex:/^[a-zA-Z\s]+$/';
            $rules['description'] = 'nullable';
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
        return [
            'title.max' => 'The title must not be greater than 50 characters.',
            'title.regex' => 'The title field should not contain numbers.',
            'title.required' => 'The title field is required.',
            'description.required' => 'The description field is required.',
        ];
    }
}
