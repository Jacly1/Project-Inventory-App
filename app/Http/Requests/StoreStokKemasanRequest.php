<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStokKemasanRequest extends FormRequest
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
            'supplier' => 'nullable|string|max:50',
            'jenis_bahan' => 'nullable|in:Kaca,Plastik,Aluminium',
            'jenis_kemasan' => 'nullable|in:Spray,Pipet,Tube,Jar,Biasa,Pump',
            'warna_badan' => 'nullable|string|max:50',
            'warna_tutup' => 'nullable|string|max:50',
            'volume' => 'nullable|integer|min:0',
            'harga' => 'nullable|integer|min:0',
            'satuan' => 'nullable|in:Buah,ml,gr',
            'jumlah' => 'nullable|integer|min:0',
            'pemeriksa' => 'nullable|string|max:50',
            'keterangan' => 'nullable|string|max:500'
        ];
    }
}
