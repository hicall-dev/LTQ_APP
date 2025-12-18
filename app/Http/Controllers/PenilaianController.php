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
        if ($auth->role != 0) abort(404);


        $currentYear  = now()->year;
        $currentMonth = now()->month;

        $title = 'Penilaian Bulan ' .  config('bulan.' . $currentMonth) . ' ' . $currentYear;

        $asatidzs = User::with(['membimbing.nilais'])->where('role', 1)->get();

        $results = [];

        foreach ($asatidzs as $asatidz) {

            $ustadzData = (object) [
                'ustadz_id'    => $asatidz->id,
                'ustadz_name'  => $asatidz->name,
                'phone'        => $asatidz->phone,
                'total_santri' => $asatidz->membimbing->count(),
                'santris'      => [],
            ];

            foreach ($asatidz->membimbing as $santri) {

                $sudahDinilaiBulanIni = $santri->nilais
                    ->where('tahun', $currentYear)
                    ->where('bulan', $currentMonth)
                    ->isNotEmpty();

                if (!$sudahDinilaiBulanIni) {
                    $ustadzData->santris[] = (object) [
                        'nis'  => $santri->nis,
                        'name' => $santri->nama,
                    ];
                }
            }

            $results[] = $ustadzData;
        }

        return view('penilaian.index', compact('title', 'results'));
    }

    public function index_old()
    {
        $auth = auth('web')->user();
        $isAdmin = $auth->role == 0;
        if (!$isAdmin) abort(404);

        $title = 'Penilaian';
        $currentYear = now()->year;
        $currentMonth = now()->month;

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

                // Kalo santri masuk nya itu sebelum bulan 9 2025 (alias fitur ini dibuat), maka penilaian hanya dihitung pada saat bulan 9 2025
                // Kalo santri masuk setelahnya, maka penilaian dihitung dari saat dia masuk
                $tahunMasukSantri = $santri->created_at->year;
                $bulanMasukSantri = $santri->created_at->month;
                if ($tahunMasukSantri < 2025 || ($tahunMasukSantri == 2025 && $bulanMasukSantri < 9)) {
                    $startMonth = 9;
                    $startYear = 2025;
                } else {
                    $startMonth = $bulanMasukSantri;
                    $startYear = $tahunMasukSantri;
                }

                // Sementara ini abaikan tahun dulu hehe
                $months = $currentYear == 2025 ? range($startMonth, $currentMonth) : range(1, $currentMonth);

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
