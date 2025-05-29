<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Nilai;
use App\Models\Santri;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Session\Session;
use PHPUnit\Framework\Constraint\Operator;

class DashboardSantriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(
            'dashboard',
            [
                'title' => 'Dashboard',
                'judul' => 'Daftar Santri',
                'santri' => Santri::when(
                    Auth::user()->role != 0,
                    fn($query) => $query->where('pembimbing_id', auth('web')->user()->id)
                )
                    ->search()
                    ->orderBy('nis')
                    ->paginate(500),

                // Data jumlah per golongan
                'putrasore' => Santri::where('golongan', 'Putra Sore')->count(),
                'putramalam' => Santri::where('golongan', 'Putra Malam')->count(),
                'putripagi' => Santri::where('golongan', 'Putri Pagi')->count(),
                'putrisore' => Santri::where('golongan', 'Putri Sore')->count(),

                // Data jumlah per status SPP
                'lunas' => Santri::where('status_spp', 1)->count(),
                'belumlunas' => Santri::where('status_spp', 0)->count(),
                'gratis' => Santri::where('status_spp', 2)->count(),
            ]
        );
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pembimbing = User::where('role', 1)->get();
        return view(
            'form',
            [
                'title' => 'Dashboard',
                'judul' => 'Tambah Santri',
                'pembimbing' => $pembimbing
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all(), auth('web')->user()->id);
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'nis' => 'required|unique:santris',
            'kelas' => 'required',
            'status_spp' => 'required',
            'golongan' => 'required',
            // 'operator_id' => 'required'
            'tanggal_lahir' => 'required',
            'tempat_lahir' => 'required',
            'pembimbing_id' => 'required'
        ]);
        $validatedData['operator_id'] = auth('web')->user()->id;
        $santri = Santri::create($validatedData); // <- $santri didefinisikan di sini

        // Simpan data payment hanya untuk bulan ini
        $now = now();

        Payment::create([
            'santri_id' => $santri->id,
            'tahun'     => $now->year,
            'bulan'     => $now->month,
            'status'    => $santri->status_spp, // langsung ikut status_spp
            'operator_id' => auth('web')->user()->id
        ]);


        return redirect('/dashboard/santri')->with('success', 'Berhasil Menambahkan');

        // $request->;

    }

    /**
     * Display the specified resource.
     */
    public function show(Santri $santri)
    {
        $user = $santri->operator;
        return view(
            'detail',
            [
                'title' => 'Dashboard',
                'judul' => 'Detail Santri',
                'santri' => $santri,
                'user' => $user,
                // 'payments' => $payments,
                // 'nilais' => $nilais
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Santri $santri)
    {
        $user = $santri->operator;
        $nilaiSekarang = $santri->nilais()
            ->where('bulan', now()->month)
            ->where('tahun', now()->year)
            ->first();
        $pembimbing = User::where('role', 1)->get();
        return view(
            'form',
            [
                'title' => 'Dashboard',
                'judul' => 'Edit Santri',
                'santri' => $santri,
                'user' => $user,
                'pembimbing' => $pembimbing,
                'nilaiSekarang' => $nilaiSekarang,  // <-- kirim ke view
            ]
        );
    }


    public function update(Request $request, Santri $santri)
    {
        $santriData = [
            'nama' => 'required|max:255',
            'kelas' => '',
            // 'status_spp' => 'required',
            'golongan' => '',
            'tanggal_lahir' => '',
            'tempat_lahir' => '',
            'pembimbing_id' => '',
        ];

        $santriNilai = [];
        if (auth('web')->user()->role == 0) {
            $santriNilai = [
                'bulanNilai' => 'array',
                'tahunNilai' => 'array',
                'hafalan' => '',
                'perkembangan' => 'array',
                'akhlak' => 'array',
            ];
        }
        if (auth('web')->user()->role == 1) {
            $santriNilai = [
                'bulanNilai' => '',
                'tahunNilai' => '',
                'hafalan' => '',
                'perkembangan' => '',
                'akhlak' => '',
            ];
        }

        $santriPayment = [
            'bulanPayment' => 'array',
            'tahunPayment' => 'array',
            'statusPayment' => 'array'
        ];

        // dd($request->all());
        if ($request->nis != $santri->nis) {
            $santri_data['nis'] = 'required|unique:santris';
        }

        $validatedData = $request->validate($santriData);

        $validatedData['operator_id'] = auth('web')->user()->id;

        if (Santri::where('id', $santri->id)->update($validatedData)) {
            if ($santri->status_spp != 2 && auth('web')->user()->role == 0) {
                $validatedPayment = $request->validate($santriPayment);
                $bulans = $validatedPayment['bulanPayment'];
                $tahuns = $validatedPayment['tahunPayment'];
                $statuses = $validatedPayment['statusPayment'];

                DB::transaction(function () use ($santri, $bulans, $tahuns, $statuses) {
                    $now = now();
                    $currentTahun = $now->year;
                    $currentBulan = $now->month;
                    for ($i = 0; $i < count($bulans); $i++) {
                        if ($bulans[$i] && $tahuns[$i] && $statuses[$i]) {
                            $payment = Payment::updateOrCreate(
                                [
                                    'santri_id' => $santri->id,
                                    'bulan' => $bulans[$i],
                                    'tahun' => $tahuns[$i]
                                ],
                                [
                                    'status' => $statuses[$i],
                                    'operator_id' => auth('web')->user()->id
                                ]
                            );
                            if ($currentTahun == $tahuns[$i] && $currentBulan == $bulans[$i]) {
                                $santriData = ['status_spp' => $statuses[$i]];
                                Santri::where('id', $santri->id)->update($santriData);
                            };
                            $payment->touch();
                        }
                    }
                });
            }
            if (auth('web')->user()->role == 0) {
                $validatedNilai = $request->validate($santriNilai);
                // dd($validatedNilai);
                $bulans = $validatedNilai['bulanNilai'];
                $tahuns = $validatedNilai['tahunNilai'];
                $perkembangans = $validatedNilai['perkembangan'];
                $akhlaks = $validatedNilai['akhlak'];

                DB::transaction(function () use ($santri, $bulans, $tahuns, $perkembangans, $akhlaks) {
                    for ($i = 0; $i < count($bulans); $i++) {
                        if (
                            isset($bulans[$i], $tahuns[$i], $perkembangans[$i], $akhlaks[$i])
                        ) {
                            $nilai = Nilai::updateOrCreate(
                                [
                                    'santri_id' => $santri->id,
                                    'bulan' => $bulans[$i],
                                    'tahun' => $tahuns[$i]
                                ],
                                [
                                    'perkembangan' => $perkembangans[$i],
                                    'akhlak' => $akhlaks[$i],
                                    'operator_id' => auth('web')->user()->id
                                ]
                            );

                            $nilai->touch();
                        }
                    }
                });
            }
            if (auth('web')->user()->role == 1) {
                if ($request->validate($santriNilai)) {
                    $bulan = now()->month;
                    $tahun = now()->year;
                    DB::transaction(function () use ($request, $santri, $bulan, $tahun) {
                        $nilai = Nilai::updateOrCreate(
                            [
                                'santri_id' => $santri->id,
                                'bulan' => $bulan,
                                'tahun' => $tahun,
                            ],
                            [
                                'hafalan' => $request->hafalan,
                                'perkembangan' => $request->perkembangan,
                                'akhlak' => $request->akhlak,
                                'operator_id' => auth('web')->id(),
                            ]
                        );
                        $nilai->touch();
                    });
                }
            }
            $santri->touch();
            return redirect('/dashboard/santri')->with('success', 'Berhasil Mengubah');
        }
        return back()->with('error', 'Gagal Mengubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Santri $santri)
    {
        // dd($santri);
        Santri::destroy($santri->id);
        return redirect('/dashboard/santri')->with('success', 'Berhasil Menghapus');
    }
}
