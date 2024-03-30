<?php

namespace App\Http\Requests\MemberPages;

use Illuminate\Foundation\Http\FormRequest;

class NewPostFormRequest extends FormRequest
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
            'title'        => 'required|string|between:1,200',
            'description'  => 'required|string|between:10,10000',
            'category'     => 'required|integer',
            'condition'    => 'required|in:new,used',
            'price'        => 'max:15',
            'age'          => 'required|string|max:15',
            'state'        => 'required|string|max:20',
            'city'         => 'required|string|max:20',
            'name'         => 'required|string|max:30',
            'address'      => 'required|string|max:100',
            'phone'        => 'required|string|max:15',
            'email'        => 'required|string|max:50',
        ];
    }
}
