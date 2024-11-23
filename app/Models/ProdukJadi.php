<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukJadi extends Model
{
    use HasFactory;

    protected $table = 'produk_jadi';
    protected $fillable = [
        'barang_id',
        'batch',
        'tgl_exp',
        'warna',
        'bentuk',
        'bau',
        'ph',
        'jlh_sampel',
        'diproduksi',
        'keterangan'
    ];

    protected $sortable = [
        'barang_id',
        'batch',
        'tgl_exp',
        'warna',
        'bentuk',
        'bau',
        'ph',
        'jlh_sampel',
        'diproduksi',
        'keterangan'
    ];

    // Relasi belongsTo ke Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('nama_barang', 'like', '%' . $search . '%');
        });
    }
}
