<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMasukRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'barang_id' => 'required|exists:barangs,id', // Pastikan barang_id ada di tabel barangs
            'jumlah' => 'required|integer|min:1', // Pastikan jumlah minimal 1
        ];
    }
}
