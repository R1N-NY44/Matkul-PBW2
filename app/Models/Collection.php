<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;
    // IGN Brindawan Tri Guna Yoga - 6706223062
    protected $fillable = [
        'namaKoleksi',
        'jenisKoleksi',
        'jumlahKoleksi',
    ];
}
