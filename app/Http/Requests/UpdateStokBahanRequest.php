<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStokBahanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Pastikan user diizinkan untuk mengupdate data
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
            'jumlah' => 'required|integer|min:0',  // Jumlah wajib diisi
            'satuan' => 'nullable|string|max:20',
            'penyimpanan' => 'nullable|in:Suhu Ruang,Kulkas',
            'pemeriksa' => 'nullable|string|max:50',
            'keterangan' => 'nullable|string|max:500',
        ];
    }

    /**
     * Get the custom messages for validation errors (optional).
     */
    public function messages(): array
    {
        return [
            'nama.required' => 'Nama barang harus diisi.',
            'jumlah.required' => 'Jumlah stok harus diisi.',
            'jumlah.integer' => 'Jumlah stok harus berupa angka.',
            'penyimpanan.in' => 'Penyimpanan hanya bisa berupa Suhu Ruangan atau Kulkas.',
        ];
    }
}