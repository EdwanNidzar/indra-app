<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Cuti;
use PDF;

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cuti = DB::table('cutis')
            ->join('users', 'cutis.user_id', '=', 'users.id')
            ->select('cutis.*', 'users.name')
            ->get();
    
        return view('cuti.index', compact('cuti'));
    }

    /**
     * Generate nomor surat
     */
    public function nomor_surat()
    {
        $increment = Cuti::count() + 1;
        $bulan = \Carbon\Carbon::now()->month;
        $bulan_romawi = $this->convertToRoman($bulan);
        $tahun = date('Y');
        $nomor = sprintf('%03d/STIEI-PC/%s/%d', $increment, $bulan_romawi, $tahun);
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
        return view('cuti.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'alasan_cuti' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
        ],
        [
            'alasan_cuti.required' => 'Alasan cuti wajib diisi',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi',
            'tanggal_selesai.required' => 'Tanggal selesai wajib diisi',
        ]);

        $cuti = new Cuti;
        $cuti->nomor_surat = $this->nomor_surat();
        $cuti->alasan_cuti = $request->alasan_cuti;
        $cuti->tanggal_mulai = $request->tanggal_mulai;
        $cuti->tanggal_selesai = $request->tanggal_selesai;
        $cuti->user_id = Auth::user()->id;
        
        if ($cuti->save()) {
            return redirect()->route('cuti.index')->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->route('cuti.index')->with('error', 'Data gagal disimpan');
        }
    }

    /**
     * Approve the specified resource from storage.
     */
    public function approve(string $id)
    {
        $cuti = Cuti::find($id);
        $cuti->status = 'approve';
        if($cuti->save()) {
            return redirect()->route('cuti.index')->with('success', 'Data berhasil disetujui');
        } else {
            return redirect()->route('cuti.index')->with('error', 'Data gagal disetujui');
        }
    }

    /**
     * Reject the specified resource from storage.
     */
    public function reject(string $id)
    {
        $cuti = Cuti::find($id);
        $cuti->status = 'reject';
        if($cuti->save()) {
            return redirect()->route('cuti.index')->with('success', 'Data berhasil ditolak');
        } else {
            return redirect()->route('cuti.index')->with('error', 'Data gagal ditolak');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = DB::table('cutis')
            ->join('users', 'cutis.user_id', '=', 'users.id')
            ->select('cutis.*', 'users.name')
            ->where('cutis.id', $id)
            ->first();
        
        return view('cuti.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Cuti::findOrfail($id);
        return view('cuti.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $cuti = Cuti::findorfail($id);

        $request->validate([
            'alasan_cuti' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
        ],
        [
            'alasan_cuti.required' => 'Alasan cuti wajib diisi',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi',
            'tanggal_selesai.required' => 'Tanggal selesai wajib diisi',
        ]);

        $cuti->nomor_surat = $request->nomor_surat;
        $cuti->alasan_cuti = $request->alasan_cuti;
        $cuti->tanggal_mulai = $request->tanggal_mulai;
        $cuti->tanggal_selesai = $request->tanggal_selesai;
        $cuti->status = 'pending';
        $cuti->user_id = Auth::user()->id;
        
        if ($cuti->save()) {
            return redirect()->route('cuti.index')->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->route('cuti.index')->with('error', 'Data gagal disimpan');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cuti = Cuti::findorfail($id);
        if($cuti->delete()) {
            return redirect()->route('cuti.index')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->route('cuti.index')->with('error', 'Data gagal dihapus');
        }
    }
}
