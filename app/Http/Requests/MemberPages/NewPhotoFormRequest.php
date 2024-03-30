<?php

namespace App\Http\Requests\MemberPages;

use Illuminate\Foundation\Http\FormRequest;

class NewPhotoFormRequest extends FormRequest
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
            'photo'   => 'required|mimes:jpeg,png,jpg|max:5120',
            'postID'  => 'required|integer',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'photo'   => ' post photo ',
            'postID'  => ' post ID ',
        ];
    }
}
