<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Santri;
use App\Models\User;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index()
    {
        $auth = auth('web')->user();
        $isAdmin = $auth->role == 0;
        if (!$isAdmin) abort(404);

        $title = 'Penilaian';
        $currentYear = now()->year;
        $currentMonth = now()->month;

        // Jika dari 2025, start dari bulan september
        $months = $currentYear == 2025 ? range(9, $currentMonth) : range(1, $currentMonth);

        $asatidzs = User::with('membimbing.nilais')->where('role', 1)->get();

        $results = [];

        foreach ($asatidzs as $asatidz) {
            $ustadzData = (object) [
                'ustadz_id'   => $asatidz->id,
                'ustadz_name' => $asatidz->name,
                'phone' => $asatidz->phone,
                'total_santri' => count($asatidz->membimbing),
                'santris'     => [],
            ];

            foreach ($asatidz->membimbing as $santri) {
                $bulanSudahDinilai = $santri->nilais
                    ->where('tahun', $currentYear)
                    ->pluck('bulan')
                    ->toArray();

                // Dapatkan bulan yang belum dinilai dari sekarang, di tahun ini
                $bulanBelumDinilai = array_diff($months, $bulanSudahDinilai);

                if (!empty($bulanBelumDinilai)) {
                    $ustadzData->santris[] = (object) [
                        'nis' => $santri->nis,
                        'name' => $santri->nama,
                        'belum_dinilai' => array_values($bulanBelumDinilai),
                    ];
                }
            }

            $results[] = $ustadzData;
        }

        return view(
            'penilaian.index',
            compact(
                'title',
                'isAdmin',
                'results',
            ),
        );
    }
}
