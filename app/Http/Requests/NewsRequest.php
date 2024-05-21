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
            'description'=> ['required','string','min:4','max:100'],
            'tags'=> ['required','string','min:3','max:1000'],
            'type'=> ['required','string','min:3','max:1000'],
            'url'=> ['required','string','min:5','max:1000'],
            'date' => ['required', 'date'],
        ];
    }

    public function messages()
    {
        return[
            'title.required'=>'El título es obligatorio',
            'title.string' => 'El título debe ser una cadena de texto.',
            'title.min'=>'El título debe tener al menos 1 caracteres',
            'title.max'=>'El títuloo debe tener menos de 50 caracteres',

            'description.required'=>'La descripción es obligatorio',
            'description.string' => 'La descripción debe ser una cadena de texto.',
            'description.min'=>'La descripción debe tener al menos 4 caracteres',
            'description.max'=>'La descripcióno debe tener menos de 100 caracteres',

            'tags.required' => 'Las etiquetas son obligatorias.',
            'tags.string' => 'Las etiquetas deben ser una cadena de texto.',
            'tags.min' => 'Las etiquetas deben tener al menos 3 caracteres.',
            'tags.max' => 'Las etiquetas no pueden tener más de 1000 caracteres.',

            'type.required' => 'El tipo es obligatorio.',
            'type.string' => 'El tipo deben ser una cadena de texto.',
            'type.min' => 'El tipo debe tener al menos 5 caracteres.',
            'type.max' => 'El tipo no puede tener más de 1000 caracteres.',

            'url.required' => 'La url es obligatoria.',
            'url.string' => 'La url deben ser una cadena de texto.',
            'url.min' => 'La url debe tener al menos 5 caracteres.',
            'url.max' => 'La url no puede tener más de 1000 caracteres.',

            'date.required' => 'El cumpleaños es obligatorio.',
            'date.date' => 'El cumpleaños tiene que ser tipo fecha.',
        ];
    }
}
