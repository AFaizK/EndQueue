<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstansiRequest extends FormRequest
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
            'nama_instansi' => 'required','string','max:255',
            'alamat'  => 'required','string','max:255',
            'logo' => 'required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048',
        ];
    }
}
