<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluar extends Model
{
    use HasFactory;

    protected $table = 'keluar';
    
    protected $fillable = [
        'barang_id',
        'jumlah',
        'tgl_keluar',
        'kategori',
        'nama_barang_jadi'
    ];

    // Relasi ke model Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('tgl_keluar', 'like', '%' . $search . '%');
        });
    }
}


