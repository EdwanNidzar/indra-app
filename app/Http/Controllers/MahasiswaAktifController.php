<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MahasiswaAktif;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PDF;

class MahasiswaAktifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->hasRole('karyawan-operator') || Auth::user()->hasRole('karyawan-admin')) {
            $mahasiswaaktif = DB::table('mahasiswa_aktifs')
                ->join('users', 'mahasiswa_aktifs.user_id', '=', 'users.id')
                ->select('mahasiswa_aktifs.*', 'users.name')
                ->get();
            return view('mahasiswaaktif.index', compact('mahasiswaaktif'));
        } else {
            $mahasiswaaktif = DB::table('mahasiswa_aktifs')
                ->join('users', 'mahasiswa_aktifs.user_id', '=', 'users.id')
                ->select('mahasiswa_aktifs.*', 'users.name')
                ->where('mahasiswa_aktifs.user_id', Auth::user()->id)
                ->get();
            return view('mahasiswaaktif.index', compact('mahasiswaaktif'));
        }
    }
    /**
     * Generate nomor surat
     */
    public function nomor_surat()
    {
        $increment = MahasiswaAktif::count() + 1;
        $bulan = \Carbon\Carbon::now()->month;
        $bulan_romawi = $this->convertToRoman($bulan);
        $tahun = date('Y');
        $nomor = sprintf('%03d/STIEI-MA/%s/%d', $increment, $bulan_romawi, $tahun);
        return $nomor;
    }

    /**
     * Convert number to roman
     */
    private function convertToRoman($number)
    {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswaaktif.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tujuan_surat' => 'required'
        ],
        [
            'tujuan_surat.required' => 'Tujuan surat wajib diisi'
        ]);

        $mahasiswaaktif = new MahasiswaAktif;
        $mahasiswaaktif->nomor_surat = $this->nomor_surat();
        $mahasiswaaktif->tujuan_surat = $request->tujuan_surat;
        $mahasiswaaktif->user_id = Auth::user()->id;

        if($mahasiswaaktif->save()) {
            return redirect()->route('mahasiswaaktif.index')->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->route('mahasiswaaktif.index')->with('error', 'Data gagal disimpan');
        }
    }

    /**
     * Approve the specified resource from storage.
     */
    public function approve(string $id)
    {
        $mahasiswaaktif = MahasiswaAktif::find($id);
        $mahasiswaaktif->status = 'approve';
        if($mahasiswaaktif->save()) {
            return redirect()->route('mahasiswaaktif.index')->with('success', 'Data berhasil disetujui');
        } else {
            return redirect()->route('mahasiswaaktif.index')->with('error', 'Data gagal disetujui');
        }
    }

    public function reject(string $id)
    {
        $mahasiswaaktif = MahasiswaAktif::find($id);
        $mahasiswaaktif->status = 'reject';
        if($mahasiswaaktif->save()) {
            return redirect()->route('mahasiswaaktif.index')->with('success', 'Data berhasil ditolak');
        } else {
            return redirect()->route('mahasiswaaktif.index')->with('error', 'Data gagal ditolak');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = DB::table('mahasiswa_aktifs')
            ->join('users', 'mahasiswa_aktifs.user_id', '=', 'users.id')
            ->select('mahasiswa_aktifs.*', 'users.name')
            ->where('mahasiswa_aktifs.id', $id)
            ->first(); // Use first() instead of get()

        return view('mahasiswaaktif.show', compact('data'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = MahasiswaAktif::where('id', $id)->first();
        return view('mahasiswaaktif.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $mahasiswaaktif = MahasiswaAktif::findOrFail($id);

        $request->validate([
            'tujuan_surat' => 'required'
        ],
        [
            'tujuan_surat.required' => 'Tujuan surat wajib diisi'
        ]);

        $mahasiswaaktif->nomor_surat = $request->nomor_surat;
        $mahasiswaaktif->tujuan_surat = $request->tujuan_surat;
        $mahasiswaaktif->user_id = Auth::user()->id;

        if($mahasiswaaktif->update()) {
            return redirect()->route('mahasiswaaktif.index')->with('success', 'Data berhasil diperbaharui');
        } else {
            return redirect()->route('mahasiswaaktif.index')->with('error', 'Data gagal diperbaharui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mahasiswaaktif = MahasiswaAktif::findOrFail($id);
        if($mahasiswaaktif->delete()) {
            return redirect()->route('mahasiswaaktif.index')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->route('mahasiswaaktif.index')->with('error', 'Data gagal dihapus');
        }
    }

    public function cetak($id)
    {
        $mahasiswaaktif = DB::table('mahasiswa_aktifs')
            ->join('users', 'mahasiswa_aktifs.user_id', '=', 'users.id')
            ->select('mahasiswa_aktifs.*', 'users.name')
            ->where('mahasiswa_aktifs.id', $id)
            ->first(); 
    
        $data = [
            'mahasiswaaktif' => $mahasiswaaktif,
            'tanggal' => date('d F Y'),
            'judul' => 'Surat Mahasiswa Aktif',
        ];
    
        // Load the PDF view and pass the $data variable
        $pdf = PDF::loadView('mahasiswaaktif.report', $data);
    
        // Return the PDF for download
        return $pdf->stream('Surat_Mahasiswa_Aktif.pdf');
    }
    

}
