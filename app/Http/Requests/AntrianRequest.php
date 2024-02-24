<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AntrianRequest extends FormRequest
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
            'id_pengunjung' => ['required'],
            'id_layanan'  => ['required'],
            'nomor_antrian' => ['required', 'string', 'max:255'],
            'tanggal_antrian' => ['required'],
        ];
    }

}
