<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penelitian extends Model
{
    use HasFactory;

    protected $table = 'penelitians';

    protected $fillable = [
        'nomor_surat',
        'tempat_penelitian',
        'judul',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'user_id'
    ];
}
