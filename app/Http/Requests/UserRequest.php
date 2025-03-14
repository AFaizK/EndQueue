<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'status' => 'required',
            'role' => 'required',
            'name' => 'required',
            'username' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
            'password' => 'sometimes|required|min:6',
            'confirm_password' => 'sometimes|required_with:password|same:password',
        ];
    }
}
