<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'title' => ['required','string','min:1','max:50'],
            'description'=> ['required','string','min:4','max:10000'],
            'tags'=> ['required','string','min:3','max:1000'],
            'type'=> ['required','string','min:3','max:1000'],
            'url'=> ['required','string','min:5','max:1000'],
        ];
    }

    public function messages()
    {
        return[
            'title.required'=>__('requests.title.required.news'),
            'title.string' => __('requests.title.string.news'),
            'title.min'=>__('requests.title.min.news'),
            'title.max'=>__('requests.title.max.news'),

            'description.required'=>__('requests.description.required.news'),
            'description.string' => __('requests.description.string.news'),
            'description.min'=> __('requests.description.min.news'),
            'description.max'=>__('requests.description.max.news'),

            'tags.required' => __('requests.tags.required.news'),
            'tags.string' => __('requests.tags.string.news'),
            'tags.min' => __('requests.tags.min.news'),
            'tags.max' => __('requests.tags.max.news'),

            'type.required' => __('requests.type.required.news'),
            'type.string' => __('requests.type.string.news'),
            'type.min' => __('requests.type.min.news'),
            'type.max' => __('requests.type.max.news'),

            'url.required' => __('requests.url.required.news'),
            'url.string' => __('requests.url.string.news'),
            'url.min' => __('requests.url.min.news'),
            'url.max' => __('requests.url.max.news'),

            'date.required' => __('requests.date.required.news'),
            'date.date' => __('requests.date.date.news'),
        ];
    }
}
