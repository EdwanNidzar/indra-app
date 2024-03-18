<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\PKL;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Log;

class PKLController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'karyawan-operator') {
            $pkl = DB::table('pkls')
                ->join('users', 'pkls.user_id', '=', 'users.id')
                ->select('pkls.*', 'users.name')
                ->get();
        } else {
            $pkl = DB::table('pkls')
                ->join('users', 'pkls.user_id', '=', 'users.id')
                ->select('pkls.*', 'users.name')
                ->where('pkls.user_id', Auth::user()->id)
                ->get();
        }

        return $pkl;
        
        // return view('pkl.index', compact('pkl'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pkl.create');
    }

        /**
     * Generate nomor surat
     */
    public function nomor_surat()
    {
        $increment = PKL::count() + 1;
        $bulan = \Carbon\Carbon::now()->month;
        $bulan_romawi = $this->convertToRoman($bulan);
        $tahun = date('Y');
        $nomor = sprintf('%03d/STIEI-PKL/%s/%d', $increment, $bulan_romawi, $tahun);
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
     * handle upload file to cloudinary
     */
    public function uploadBuktiPembayaran(Request $request)
    {
        $path = 'STIEI/PKL/bukti_pembayaran';
        $file = $request->file('bukti_pembayaran')->getClientOriginalName();

        $fileName = pathinfo($file, PATHINFO_FILENAME);

        $publicId = date('Y-m-d_His') . '_' . $fileName;
        $uploadBuktiPembayaran = Cloudinary::upload($request->file('bukti_pembayaran')->getRealPath(), [
            'folder' => $path,
            'public_id' => $publicId
        ]);

        return $uploadBuktiPembayaran;
    }

    public function uploadSuratPernyatan(Request $request)
    {
        $path = 'STIEI/PKL/surat_pernyataan';
        $file = $request->file('surat_pernyataan')->getClientOriginalName();

        $fileName = pathinfo($file, PATHINFO_FILENAME);

        $publicId = date('Y-m-d_His') . '_' . $fileName;
        $uploadSuratPernyatan = Cloudinary::upload($request->file('surat_pernyataan')->getRealPath(), [
            'folder' => $path,
            'public_id' => $publicId
        ]);

        return $uploadSuratPernyatan;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tempat_pkl' => 'required',
            'lama_pkl' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'bukti_pembayaran' => 'required|file|mimes:pdf|max:2048',
            'surat_pernyataan' => 'required|file|mimes:pdf|max:2048',
        ], [
            'tempat_pkl.required' => 'Tempat PKL wajib diisi',
            'lama_pkl.required' => 'Lama PKL wajib diisi',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi',
            'tanggal_selesai.required' => 'Tanggal selesai wajib diisi',
            'bukti_pembayaran.required' => 'Bukti pembayaran wajib diisi',
            'bukti_pembayaran.file' => 'Bukti pembayaran harus berupa file',
            'bukti_pembayaran.mimes' => 'Bukti pembayaran harus berupa file PDF',
            'bukti_pembayaran.max' => 'Bukti pembayaran maksimal 2MB',
            'surat_pernyataan.required' => 'Surat pernyataan wajib diisi',
            'surat_pernyataan.file' => 'Surat pernyataan harus berupa file',
            'surat_pernyataan.mimes' => 'Surat pernyataan harus berupa file PDF',
            'surat_pernyataan.max' => 'Surat pernyataan maksimal 2MB',
        ]);
    
        try {
            $pkl = new PKL;
            $pkl->nomor_surat = $this->nomor_surat();
            $pkl->tempat_pkl = $request->tempat_pkl;
            $pkl->lama_pkl = $request->lama_pkl;
            $pkl->tanggal_mulai = $request->tanggal_mulai;
            $pkl->tanggal_selesai = $request->tanggal_selesai;
            
            // Upload bukti pembayaran
            $uploadBuktiPembayaran = $this->uploadBuktiPembayaran($request);
            $pkl->bukti_pembayaran = $uploadBuktiPembayaran->getSecurePath();
    
            // Upload surat pernyataan
            $uploadSuratPernyatan = $this->uploadSuratPernyatan($request);
            $pkl->surat_pernyataan = $uploadSuratPernyatan->getSecurePath();
    
            $pkl->user_id = Auth::user()->id;
          
            if($pkl->save()) {
                return redirect()->route('pkl.index')->with('success', 'Data berhasil disimpan');
            } else {
                return redirect()->route('pkl.index')->with('error', 'Data gagal disimpan');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
