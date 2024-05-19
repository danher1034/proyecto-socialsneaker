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
            'text.required'=>'El texto es obligatorio',
            'text.string' => 'El texto debe ser una cadena de texto.',
            'text.min'=>'El texto debe tener al menos 1 caracteres',
            'text.max'=>'El texto debe tener menos de 100 caracteres',

            'collection_id.required' => 'Error al comentar esta publicación',
        ];
    }
}
