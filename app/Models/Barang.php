<?php

namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Barang extends Model
{
    use HasFactory, Sortable, SoftDeletes;

    protected $table = 'barang';
    protected $fillable = [
        'nama_barang', 
        'jumlah',
        'kategori_barang'
    ];

    public $sortable = [
        'nama_barang', 
        'jumlah',
        'kategori_barang'
    ];

    protected $guarded = [
        'id',
    ];

    protected $with = [
        'stok',
        'bahanBaku',
        'kemasan',
        'produkJadi',
        'masuk',
        'keluar'
    ];

    // Relasi ke BahanBaku
    public function stok()
    {
        return $this->hasOne(Stok::class, 'barang_id');
    }

    // Relasi one-to-one ke BahanBaku
    public function bahanBaku()
    {
        return $this->hasOne(BahanBaku::class, 'barang_id');
    }

    // Relasi one-to-one ke Kemasan
    public function kemasan()
    {
        return $this->hasOne(Kemasan::class, 'barang_id');
    }

    // Relasi one-to-one ke Produk Jadi
    public function produkJadi()
    {
        return $this->hasOne(ProdukJadi::class, 'barang_id');
    }

    // Relasi one-to-many ke Masuk
    public function masuk()
    {
        return $this->hasMany(Masuk::class, 'barang_id');
    }

    // Relasi one-to-many ke Keluar
    public function keluar()
    {
        return $this->hasMany(Keluar::class, 'barang_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('nama_barang', 'like', '%' . $search . '%');
        });
    }
}
