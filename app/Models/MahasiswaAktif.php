<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaAktif extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa_aktifs';

    protected $fillable = [
        'nomor_surat',
        'tujuan_surat',
        'status',
        'user_id'
    ];
}
