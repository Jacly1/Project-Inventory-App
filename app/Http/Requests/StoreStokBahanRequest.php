<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStokBahanRequest extends FormRequest
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
            'batch' => 'nullable|string|max:50',
            'tgl_exp' => 'nullable|date',  // Tidak perlu max:50 karena ini adalah tanggal
            'warna' => 'nullable|string|max:50',
            'bentuk' => 'nullable|in:Cair,Cairan Kental,Butter,Serbuk,Pellet',
            'harga' => 'nullable|integer|min:0',
            'satuan' => 'nullable|in:Buah,ml,gr',
            'jumlah' => 'nullable|integer|min:0',
            'penyimpanan' => 'nullable|in:Suhu Ruang,Kulkas', // Disesuaikan dengan konsistensi enum
            'pemeriksa' => 'nullable|string|max:50',
            'keterangan' => 'nullable|string|max:500'
        ];
    }
}
