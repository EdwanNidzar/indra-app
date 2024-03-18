<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Penelitian;
use PDF;

class PenelitianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penelitian = DB::table('penelitians')
            ->join('users', 'penelitians.user_id', '=', 'users.id')
            ->select('penelitians.*', 'users.name')
            ->get();
    
        return view('penelitian.index', compact('penelitian'));

        // return $penelitian;
    }

    /**
     * Generate nomor surat
     */
    public function nomor_surat()
    {
        $increment = Penelitian::count() + 1;
        $bulan = \Carbon\Carbon::now()->month;
        $bulan_romawi = $this->convertToRoman($bulan);
        $tahun = date('Y');
        $nomor = sprintf('%03d/STIEI-IP/%s/%d', $increment, $bulan_romawi, $tahun);
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
        return view('penelitian.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tempat_penelitian' => 'required',
            'judul' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required'
        ],
        [
            'tempat_penelitian.required' => 'Tempat penelitian wajib diisi',
            'judul.required' => 'Judul wajib diisi',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi',
            'tanggal_selesai.required' => 'Tanggal selesai wajib diisi'
        ]);

        $penelitian = new Penelitian;
        $penelitian->nomor_surat = $this->nomor_surat();
        $penelitian->tempat_penelitian = $request->tempat_penelitian;
        $penelitian->judul = $request->judul;
        $penelitian->tanggal_mulai = $request->tanggal_mulai;
        $penelitian->tanggal_selesai = $request->tanggal_selesai;
        $penelitian->user_id = Auth::id();

        if($penelitian->save()) {
            return redirect()->route('penelitian.index')->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->route('penelitian.index')->with('error', 'Data gagal disimpan');
        }
    }

    /**
     * Approve the specified resource from storage.
     */
    public function approve(string $id)
    {
        $penelitian = Penelitian::find($id);
        $penelitian->status = 'approve';
        if($penelitian->save()) {
            return redirect()->route('penelitian.index')->with('success', 'Data berhasil disetujui');
        } else {
            return redirect()->route('penelitian.index')->with('error', 'Data gagal disetujui');
        }
    }

    /**
     * Reject the specified resource from storage.
     */
    public function reject(string $id)
    {
        $penelitian = Penelitian::find($id);
        $penelitian->status = 'reject';
        if($penelitian->save()) {
            return redirect()->route('penelitian.index')->with('success', 'Data berhasil ditolak');
        } else {
            return redirect()->route('penelitian.index')->with('error', 'Data gagal ditolak');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = DB::table('penelitians')
            ->join('users', 'penelitians.user_id', '=', 'users.id')
            ->select('penelitians.*', 'users.name')
            ->where('penelitians.id', $id)
            ->first();
        
        return view('penelitian.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Penelitian::findOrfail($id);
        return view('penelitian.edit', compact('data'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $penelitian = Penelitian::findOrfail($id);

        $request->validate([
            'tempat_penelitian' => 'required',
            'judul' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required'
        ],
        [
            'tempat_penelitian.required' => 'Tempat penelitian wajib diisi',
            'judul.required' => 'Judul wajib diisi',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi',
            'tanggal_selesai.required' => 'Tanggal selesai wajib diisi'
        ]);

        
        $penelitian->nomor_surat = $request->nomor_surat;
        $penelitian->tempat_penelitian = $request->tempat_penelitian;
        $penelitian->judul = $request->judul;
        $penelitian->tanggal_mulai = $request->tanggal_mulai;
        $penelitian->tanggal_selesai = $request->tanggal_selesai;
        $penelitian->status = 'pending';
        $penelitian->user_id = Auth::id();

        if($penelitian->update()) {
            return redirect()->route('penelitian.index')->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->route('penelitian.index')->with('error', 'Data gagal disimpan');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penelitian = Penelitian::findOrfail($id);
        if($penelitian->delete()) {
            return redirect()->route('penelitian.index')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->route('penelitian.index')->with('error', 'Data gagal dihapus');
        }
    }
}
