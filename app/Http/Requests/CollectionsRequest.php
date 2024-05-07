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
            'description'=> ['required','string','min:10','max:100'],
            'date' => ['required', 'date', 'after_or_equal:' . now()->format('Y-m-d')],
            'tags'=> ['required','string','min:3','max:1000'],
        ];
    }

    public function messages()
    {
        return[
            'description.required'=>'La descripción es obligatorio',
            'description.string' => 'La descripción debe ser una cadena de texto.',
            'description.min'=>'La descripción debe tener al menos 10 caracteres',
            'description.max'=>'La descripcióno debe tener menos de 100 caracteres',

            'date.required' => 'La fecha es obligatoria.',
            'date.date' => 'La fecha debe ser una fecha válida.',
            'date.after_or_equal' => 'La fecha no puede anterio a hoy.',

            'tags.required' => 'Las etiquetas son obligatorias.',
            'tags.string' => 'Las etiquetas deben ser una cadena de texto.',
            'tags.min' => 'Las etiquetas deben tener al menos 3 caracteres.',
            'tags.max' => 'Las etiquetas no pueden tener más de 1000 caracteres.',
        ];
    }
}
