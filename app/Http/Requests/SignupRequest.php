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
        $rules= [
            'birthday' => ['required', 'date', 'before_or_equal:' . now()->subYears(16)->format('Y-m-d')],
            'password' => ['required'],
        ];

        if(!empty($this->request->get('newpassword'))){
            $rules['newpassword']=['string','min:8', 'confirmed', Rules\Password::default()];
        }

        return $rules;
    }

    public function messages()
    {
        return[

            'password.required' => 'La contraseña es obligatoria.',

            'birthday.required' => 'El cumpleaños es obligatorio.',
            'birthday.date' => 'El cumpleaños tiene que ser tipo fecha.',
            'birthday.before_or_equal' => 'Tienes que tener más de 16 años.',

            'newpassword.confirmed' => 'Las contraseñas no coinciden.',
            'newpassword.min' => 'La contraseña debe tener como mínimo 8 caracteres.',
            'newpassword.string' => 'La contraseña debe ser una cadena de texto.',
        ];
    }
}
