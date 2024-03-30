<?php

namespace App\Http\Requests\MemberPages;

use Illuminate\Foundation\Http\FormRequest;

use App\Models\User;

// Import class for using Authentication
use Illuminate\Support\Facades\Auth;

class ProfileEditingRequest extends FormRequest
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
                'ID'                => 'required',
                'profilePhoto'      => 'mimes:jpeg,png,jpg|max:5120',
                'firstname'         => 'required|string|max:21',
                'middlename'        => 'max:21',
                'surname'           => 'required|string|max:21',
                'phone'             =>  'max:15',
                'date_of_birth'     =>  'string|max:10',
                'gender'            =>  'in:male,female',
                'city'              =>  'max:30',
                'state'             =>  'max:30',
                'address'           =>  'max:200',
                'postcode'          =>  'max:18',
                'about_me'          =>  'max:215',
                'hobbies'           =>  'max:500',
                'religion'          =>  'max:15',
                'religious_level'   =>  'in:"very religious","moderately religious","a little religious","not religious"',
            ];
/*
        if(Auth::user()->email == 'email')
        {
            return [
                'ID'                => 'required',
                'profilePhoto'      => 'mimes:jpeg,png,jpg|max:5120',
                'firstname'         => 'required|string|max:21',
                'middlename'        => 'max:21',
                'surname'           => 'required|string|max:21',
                'phone'             =>  'max:15',
                'date_of_birth'     =>  'string|max:10',
                'gender'            =>  'in:male,female',
                'city'              =>  'max:30',
                'state'             =>  'max:30',
                'address'           =>  'max:200',
                'postcode'          =>  'max:18',
                'about_me'          =>  'max:215',
                'hobbies'           =>  'max:500',
                'religion'          =>  'max:15',
                'religious_level'   =>  'in:"very religious","moderately religious","a little religious","not religious"',
            ];
        }
        else {
            return [
                'ID'                => 'required',
                'profilePhoto'      => 'mimes:jpeg,png,jpg|max:5120',
                'firstname'         => 'required|string|max:21',
                'middlename'        => 'max:21',
                'surname'           => 'required|string|max:21',
                'email'             => 'required|string|email|max:255|unique:'.User::class,
                'phone'             =>  'max:15',
                'date_of_birth'     =>  'string|max:10',
                'gender'            =>  'in:male,female',
                'city'              =>  'max:30',
                'state'             =>  'max:30',
                'address'           =>  'max:200',
                'postcode'          =>  'max:18',
                'about_me'          =>  'max:215',
                'hobbies'           =>  'max:500',
                'religion'          =>  'max:15',
                'religious_level'   =>  'in:"very religious","moderately religious","a little religious","not religious"',
            ];   
        }
*/
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'profilePhoto'    => ' profile photo ',
            'ID'              => ' user ID ',
            'firstname'       => ' first name ',
            'middlename'      => ' middle name ',
            'about_me'        => ' about me ',
            'religious_level' => ' religious level ',
        ];
    }
}
