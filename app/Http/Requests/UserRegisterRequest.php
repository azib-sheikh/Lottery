<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'name'          => 'required|string',
            'email'         => 'required|email|unique:users,email',
            'mobile'        => 'required|regex:/^[0-9]{10}$/|unique:users,mobile',
            // 'date_of_birth' => 'required|date|before:-18 years',
            'password'      => 'required|min:8',
            'tnc'           => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter name',
            'email.required' => 'Please enter email',
            'email.email' => 'Please enter correct email',
            'mobile.required' => 'Please enter mobile number',
            // 'mobile.regex' => 'Please enter Correct mobile number',
            // 'date_of_birth.required' => 'Please enter Valid date of birth',
            // 'date_of_birth.before' => 'Minimum age to access this website is 18 Years',
            'tnc.required' => 'Please accept terms and conditions'
        ];
    }
}
