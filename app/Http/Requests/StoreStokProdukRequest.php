<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStokProdukRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:50',
            'jumlah' => 'nullable|integer|min:0',
            'batch' => 'nullable|string|max:50',
            'tgl_exp' => 'nullable|date',
            'warna' => 'nullable|string|max:50',
            'bentuk' => 'nullable|string|max:50',
            'bau' => 'nullable|string|max:50',
            'ph' => 'nullable|numeric|min:0|max:14',
            'jlh_sampel' => 'nullable|integer|min:0',
            'diproduksi' => 'nullable|string|max:50',
            'keterangan' => 'nullable|string|max:50',
        ];
    }
}
