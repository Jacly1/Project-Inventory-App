<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kemasan extends Model
{
    use HasFactory;
    protected $table = 'kemasan';

    protected $fillable = [
        'barang_id',
        'supplier',
        'jenis_bahan',
        'jenis_kemasan',
        'warna_badan',
        'warna_tutup',
        'volume',
        'harga',
        'pemeriksa',
        'keterangan'
        ];
    
    protected $sortable = [
        'barang_id',
        'supplier',
        'jenis_bahan',
        'jenis_kemasan',
        'warna_badan',
        'warna_tutup',
        'volume',
        'harga',
        'pemeriksa',
        'keterangan'
    ];
    
    protected $guarded = [
        'id',
    ];

    // Relasi belongsTo ke Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('supplier', 'like', '%' . $search . '%');
        });
    }
}
