<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CollectionsRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'description'=> ['required','string','min:4','max:100'],
            'tags'=> ['required','string','min:3','max:1000'],
        ];
    }

    public function messages()
    {
        return[
            'description.required' => __('requests.description.required.collection'),
            'description.string' => __('requests.description.string.collection'),
            'description.min' => __('requests.description.min.collection'),
            'description.max' => __('requests.description.max.collection'),

            'tags.required' => __('requests.tags.required.collection'),
            'tags.string' => __('requests.tags.string.collection'),
            'tags.min' => __('requests.tags.min.collection'),
            'tags.max' => __('requests.tags.max.collection'),
        ];
    }
}
