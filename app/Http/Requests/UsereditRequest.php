<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsereditRequest extends FormRequest
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

            'password.required' => __('requests.password.required.user'),

            'birthday.required' =>  __('requests.birthday.required.user'),
            'birthday.date' =>  __('requests.birthday.date.user'),
            'birthday.before_or_equal' =>  __('requests.birthday.before_or_equal.user'),

            'newpassword.confirmed' =>  __('requests.newpassword.confirmed.user'),
            'newpassword.min' =>  __('requests.newpassword.min.user'),
            'newpassword.string' =>  __('requests.newpassword.string.user'),
        ];
    }
}

