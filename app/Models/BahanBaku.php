<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanBaku extends Model
{
    use HasFactory;

    protected $table = 'bahan_baku';
    
    protected $fillable = [
        'barang_id',
        'supplier', 
        'batch', 
        'tgl_exp', 
        'warna', 
        'bentuk', 
        'harga',
        'penyimpanan', 
        'pemeriksa',
        'keterangan'
    ];

    protected $sortable = [
        'barang_id',
        'supplier', 
        'batch', 
        'tgl_exp', 
        'warna', 
        'bentuk', 
        'harga',
        'penyimpanan', 
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
