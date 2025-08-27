<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Santri;
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
        // Jika dari 2025, start dari bulan mei
        $months = $currentYear == 2025 ? range(5, $currentMonth) : range(1, $currentMonth);

        $santris = Santri::with(
            ['nilais', 'pembimbing']
        )
        ->searchByNilai()
        ->orderBy('nis')
        ->get();

        $results = [];

        foreach($santris as $santri) {
            /// Ambil bulan yang sudah dinilai
            $doneNilaiByMonth = $santri->nilais->pluck('bulan')->toArray();

            /// Ambil bulan yang belum dari bulan 5
            $diffMonth = collect(array_diff($months, $doneNilaiByMonth))
                    ->map(fn($month) => config('bulan.' . $month))
                    ->values();

            if (!empty($diffMonth)) {
                $results[] = (object) [
                    'santri' => $santri,
                    'belum_dinilai' => $diffMonth,
                ];
            }

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
