<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentsRequest extends FormRequest
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
            'text'=> ['required','string','min:1','max:100'],
            'collection_id'=> ['required'],
        ];
    }

    public function messages()
    {
        return[
            'text.required'=> __('requests.text.required.collection'),
            'text.string' => __('requests.text.string.collection'),
            'text.min'=>__('requests.text.min.collection'),
            'text.max'=>__('requests.text.max.collection'),

            'collection_id.required' => __('requests.collection_id.required.collection'),
        ];
    }
}
