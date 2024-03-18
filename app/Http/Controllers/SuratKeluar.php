<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class SuratKeluar extends Controller
{
    public function cetak()
    {
        $countPenelitians = DB::table('penelitians')->count();
        $countCutis = DB::table('cutis')->count();
        $countPkls = DB::table('pkls')->count();
        $countMahasiswaAktifs = DB::table('mahasiswa_aktifs')->count();

        $data = [
            'penelitian' => $countPenelitians,
            'cuti' => $countCutis,
            'pkl' => $countPkls,
            'mahasiswaaktif' => $countMahasiswaAktifs,
            'tanggal' => date('d F Y'),
            'judul' => 'Surat Keluar',
        ];

        // Load the PDF view and pass the $data variable
        $pdf = PDF::loadView('suaratkeluar.cetak', $data);

        // Return the PDF for download
        return $pdf->stream('Surat_Keluar.pdf');
    }
}
