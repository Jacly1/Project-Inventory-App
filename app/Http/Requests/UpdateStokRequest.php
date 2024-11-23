<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStokRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Adjust permission checks if needed
    }

    public function rules(): array
    {
        return [
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:0',
            'keterangan' => 'nullable|string|max:500'
        ];
    }
}
