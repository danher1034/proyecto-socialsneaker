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
            'name' => ['required','string','min:5','max:15'],
            'description'=> ['required','string','min:10','max:10000'],
            'location'=> ['required','string','min:3','max:1000'],
            'date' => ['required', 'date', 'after_or_equal:' . now()->format('Y-m-d')],
            'hour' => ['required', 'date_format:H:i:s'],
            'type' => ['required','string', 'in:official,exhibition,charity'],
            'tags'=> ['required','string','min:3','max:1000'],
        ];
    }
}
