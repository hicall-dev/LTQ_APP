<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\Payment;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
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
            'nama_santri' => 'nullable',
            'jenis_kelamin' => 'nullable',
            'nama_ayah' => 'nullable',
            'ttl_santri' => 'nullable',
            'alamat_santri' => 'nullable',
            'wa_santri' => 'nullable',
            'asal_sekolah' => 'nullable',
            'nama_wali' => 'nullable',
            'ttl_wali' => 'nullable',
            'alamat_wali' => 'nullable',
            'wa_wali' => 'nullable',
            'kelas' => 'nullable',
            'signature_data' => 'nullable', // Validasi untuk tanda tangan
        ]);
        // Ubah huruf pertama kata di semua field kecuali 'signature_data'
        foreach ($validatedData as $key => $value) {
            // Mengecek jika field bukan 'signature_data' dan ada nilai
            if ($key !== 'signature_data' && !empty($value)) {
                // Ubah menjadi huruf kapital di awal kata
                $validatedData[$key] = ucwords(strtolower($value));
            }
        }
        session(['data' => $validatedData]);
        // dd(session('data'));

        // Kirim data ke view
        // return view('formdaftar', [
        //     'data' => $validatedData
        // ]);
        return redirect()->back();
    }


    public function unduhFormulir()
    {
        // Ambil data dari session
        $formData = session('data', []);

        // Buat PDF menggunakan DomPDF
        $pdf = PDF::loadView('formdaftar', ['data' => $formData]);

        // Setel ukuran kertas A4 dan orientasi portrait
        $pdf->setPaper('A4', 'portrait'); // Atau 'landscape'

        // Set margin menjadi 0 (none)
        $pdf->setOption('margin-top', 0);
        $pdf->setOption('margin-right', 0);
        $pdf->setOption('margin-bottom', 0);
        $pdf->setOption('margin-left', 0);

        // Set scale menjadi 100% (fit to page)
        $pdf->setOption('scale', 1); // DomPDF secara default memiliki scale 1 yang berarti 100%

        // Set pages per sheet menjadi 1 (ini untuk memastikan satu halaman per sheet)
        $pdf->setOption('page-width', 210);  // Lebar A4 dalam mm
        $pdf->setOption('page-height', 297); // Tinggi A4 dalam mm

        // Hapus data session setelah digunakan
        session()->flush();

        // Unduh file PDF
        return $pdf->download('Formulir_Pendaftaran.pdf');
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
            $bulanLalu = now()->subMonth(); // Mendapatkan bulan sebelumnya secara otomatis
            $nilaiSekarang = $santri->nilais()
                ->where('bulan', $bulanLalu->month)
                ->where('tahun', $bulanLalu->year)
                ->first();

            $materi = isset($materiHafalan[$santri->kelas]) ? $materiHafalan[$santri->kelas] : null;
            return view('check', compact('santri', 'title', 'materi', 'nilaiSekarang'));
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
        $operatorId = Auth::id();
        $now = now();
        $bulan = $now->month;
        $tahun = $now->year;

        // Ambil semua santri yang status_spp-nya bukan gratis (2)
        $santris = Santri::where('status_spp', '!=', 2)->get();

        DB::beginTransaction();
        try {
            foreach ($santris as $santri) {
                // Update status_spp di tabel santris
                $santri->update([
                    'status_spp' => 0,
                    'operator_id' => $operatorId,
                ]);
                $santri->touch();
                // Update atau buat data di tabel payments
                $payment = Payment::updateOrCreate(
                    [
                        'santri_id' => $santri->id,
                        'bulan'     => $bulan,
                        'tahun'     => $tahun,
                    ],
                    [
                        'status' => 0, // Belum lunas
                        'operator_id' => auth('web')->user()->id
                    ]
                );
                // Paksa update updated_at meskipun status tidak berubah
                $payment->touch();
            }

            DB::commit();
            return redirect('/dashboard/santri')->with('success', 'Status SPP berhasil direset di semua tempat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal mereset status SPP: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Lokasi file yang akan diganti
        $targetPath = public_path('img/popup.jpg');

        // Hapus file popup.jpg jika ada
        if (file_exists($targetPath)) {
            unlink($targetPath);
        }

        // Simpan file yang diunggah sebagai popup.jpg
        $request->image->move(public_path('img'), 'popup.jpg');

        return back()->with('success', 'Image uploaded successfully.');
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     // Tentukan path file target secara relatif ke folder aplikasi
    //     $targetPath = base_path('../public_html/img/popup.jpg'); // Pastikan path ini sesuai dengan struktur server Anda

    //     // Hapus file popup.jpg jika ada
    //     if (file_exists($targetPath)) {
    //         unlink($targetPath);
    //     }

    //     // Simpan file yang diunggah sebagai popup.jpg
    //     $request->image->move(dirname($targetPath), 'popup.jpg');

    //     return back()->with('success', 'Image uploaded successfully.');
    // }

}
