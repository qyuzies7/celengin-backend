<?php

namespace App\Filament\Resources\PenggunaResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePenggunaRequest extends FormRequest
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
			'nama' => 'required',
			'email' => 'required',
			'password' => 'required',
			'terakhir_login' => 'required'
		];
    }
}
