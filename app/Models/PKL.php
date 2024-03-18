<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PKL extends Model
{
    use HasFactory;

    protected $table = 'pkls';

    protected $fillable = [
        'nomor_surat',
        'tempat_pkl',
        'lama_pkl',
        'tanggal_mulai',
        'tanggal_selesai',
        'bukti_pembayaran',
        'surat_pernyataan',
        'status',
        'user_id'
    ];
}
