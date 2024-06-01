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
            'name.required' => __('requests.name.required.sign'),
            'name.min' => __('requests.name.min.sign'),
            'name.max' => __('requests.name.max.sign'),
            'name.unique' => __('requests.name.unique.sign'),
            'name.string' => __('requests.name.string.sign'),

            'birthday.required' => __('requests.birthday.required.sign'),
            'birthday.date' => __('requests.birthday.date.sign'),
            'birthday.before_or_equal' => __('requests.birthday.before_or_equal.sign'),

            'email.required' => __('requests.email.required.sign'),
            'email.unique' => __('requests.email.unique.sign'),
            'email.min' => __('requests.email.min.sign'),
            'email.max' => __('requests.email.max.sign'),
            'email.string' => __('requests.email.string.sign'),

            'password.required' => __('requests.password.required.sign'),
            'password.confirmed' => __('requests.password.confirmed.sign'),
            'password.min' => __('requests.password.min.sign'),
            'password.string' => __('requests.password.string.sign'),
        ];
    }
}
