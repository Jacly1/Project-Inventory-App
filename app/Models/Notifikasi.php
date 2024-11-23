<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;
    protected $table = 'notifikasi';
    protected $fillable = [
        'tgl_notif',
        'jenis_notif',
        'desc',
        'link',
        'status'
        ];
}
