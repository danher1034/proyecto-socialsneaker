<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;


class SignupRequest extends FormRequest
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
            'name' => ['required','string','min:5','max:20','unique:users'],
            'birthday' => ['required', 'date', 'before_or_equal:' . now()->subYears(16)->format('Y-m-d')],
            'email' => ['required','string', 'min:10', 'max:255' , 'unique:users'],
            'password' => ['required','min:8', 'confirmed', Rules\Password::default()],
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'El nombre de usuario es obligatorio.',
            'name.min' => 'El nombre de usuario debe tener como mínimo 5 caracteres.',
            'name.max' => 'El nombre de usuario debe tener como máximo 20 caracteres.',
            'name.unique' => 'El nombre de usuario ya existe en el sistema.',
            'name.string' => 'El nombre debe ser una cadena de texto.',

            'birthday.required' => 'El cumpleaños es obligatorio.',
            'birthday.date' => 'El cumpleaños tiene que ser tipo fecha.',
            'birthday.before_or_equal' => 'Tienes que tener más de 16 años.',

            'email.required' => 'El email es obligatorio.',
            'email.unique' => 'El email ya existe en el sistema.',
            'email.min' => 'El email debe tener como mínimo 10 caracteres.',
            'email.max' => 'El email debe tener como máximo 255 caracteres.',
            'email.string' => 'El email debe ser una cadena de texto.',

            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener como mínimo 8 caracteres.',
            'password.string' => 'La contraseña debe ser una cadena de texto.',
        ];
    }
}
