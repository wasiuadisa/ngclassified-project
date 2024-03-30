<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordChangingRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'password'              => 'required|string|between:6,20',
            'password_confirmation' => 'same:password',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function attributes(): array
    {
        return [
            'password'              => 'password',
            'password_confirmation' => 'confirmation of password',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function messages(): array
    {
        return [
            'password.required'      => 'Your password is required',
            'password.string' => 'Your password is not valid',
            'password.between:6,20'  => 'Your password should not be longer than 20 characters',
        ];
    }
}
