<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SantriController extends Controller
{
    //
    public function index()
    {
        return view(
            'dashboard',
            [
                'title' => 'Dashboard',
                'judul' => 'Daftar Santri',

                'santris' => Santri::search()->orderBy('nama')->paginate(10)
            ]
        );
    }

    // public function create(): View
    // {
    //     return ;
    // }

    public function daftar(Request $request)
    {
        // dd($request);
        // Validasi input
        $validatedData = $request->validate([
            'nama_santri' => 'required',
            'jenis_kelamin' => 'required',
            'nama_ayah' => 'required',
            'ttl_santri' => 'required',
            'alamat_santri' => 'required',
            'wa_santri' => 'required',
            'asal_sekolah' => 'required',
            'nama_wali' => 'required',
            'ttl_wali' => 'required',
            'alamat_wali' => 'required',
            'wa_wali' => 'required',
            'kelas' => 'required',
            'signature_data' => 'nullable', // Validasi untuk tanda tangan
        ]);

        // Kirim data ke view
        return view('formdaftar', [
            'data' => $validatedData
        ]);
    }



    public function cek(Request $request)
    {
        // Ambil parameter NIS dari input query
        $nis = $request->input('nis');

        // Lakukan pencarian santri berdasarkan NIS
        $santri = Santri::where(
            'nis',
            $nis
        )->first();

        $urlPath = $request->path(); // Gets the request path
        $title = match ($urlPath) {
            'status_spp' => 'CEK STATUS SPP',
            'status_kelas' => 'CEK PERKEMBANGAN SANTRI',
            default => 'Default Title'
        };

        $materiHafalan = [
            'Tahsin Awwal' => 'Surat Al Maun s/d Annas',
            'Tahsin Akhir' => 'Surat At Takatsur s/d Quraisy',
            'Mutawassith' => 'Juz 30 / Juz Amma',
            'Pra Takhossus Awwal' => 'Separuh Juz 29 Awal',
            'Pra Takhossus Akhir' => 'Separuh Juz 29 Akhir',
            'Takhossus Awwal' => 'Juz 1 s/d juz 5',
            'Takhossus Tsani' => 'Juz 6 s/d juz 10',
            'Takhossus Tsalits' => 'Juz 11 s/d juz 15',
            'Takhossus Robi' => 'Juz 16 s/d juz 20',
            'Takhossus Khomis' => 'Juz 21 s/d juz 25',
            'Takhossus Akhir' => 'Juz 26 s/d juz 30',
        ];

        // Cek apakah santri ditemukan
        if ($santri) {
            $materi = isset($materiHafalan[$santri->kelas]) ? $materiHafalan[$santri->kelas] : null;
            return view('check', compact('santri', 'title', 'materi'));
        } else {
            return redirect()->back()->with('error', 'Santri tidak ditemukan');
        }
    }

    public function read($nis): View
    {
        $santri = DB::table('santris')
            ->join('users', 'santris.operator_id', '=', 'users.id')
            ->where('santris.nis', $nis)
            ->select('santris.*', 'users.name as operator_name')
            ->first();
        return view(
            'detail',
            [
                'title' => 'Dashboard',
                'judul' => 'Detail Santri',
                'santri' => $santri
            ]
        );
    }

    public function update($nis): View
    {
        $santri = DB::table('santris')
            ->where('santris.nis', $nis)
            ->first();
        return view(
            'form',
            [
                'title' => 'Dashboard',
                'judul' => 'Edit Santri',
                'santri' => $santri
            ]
        );
    }

    // public function delete($nis): View
    // {
    //     $santri = DB::table('santris')
    //         ->where('santris.nis', $nis)
    //         ->first();
    //     return view(
    //         'form',
    //         [
    //             'title' => 'Dashboard',
    //             'judul' => 'Edit Santri',
    //             'santri' => $santri
    //         ]
    //     );
    // }

    public function resetStatusSPP()
    {
        // Mendapatkan ID operator saat ini
        $operatorId = Auth::id();

        // Mengubah semua status_spp menjadi 0 dan menyetelnya dengan operator_id yang baru
        Santri::query()->update([
            'status_spp' => 0,
            'operator_id' => $operatorId,
        ]);

        // Mengirimkan pesan sukses
        return redirect('/dashboard/santri')->with('success', 'Status SPP berhasil direset.');
    }
}
