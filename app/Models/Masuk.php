<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masuk extends Model
{
    use HasFactory;

    protected $table = 'masuk';
    
    protected $fillable = [
        'barang_id', 
        'jumlah', 
        'tgl_masuk'
    ];


    // Relasi belongsTo ke Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id')->withTrashed();
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('tgl_masuk', 'like', '%' . $search . '%');
        });
    }
}
