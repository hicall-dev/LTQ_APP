<?php

namespace App\Http\Controllers;

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
        //
        // $dump = Santri::where('operator_id', Auth::id())->get();
        // $dump = Auth::id();
        //          dd($dump);

        return view(
            'dashboard',
            [
                'title' => 'Dashboard',
                'judul' => 'Daftar Santri',
                'santri' => Santri::search()->orderBy('nis')->paginate(100),
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
        return view(
            'form',
            [
                'title' => 'Dashboard',
                'judul' => 'Tambah Santri'
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
            'tempat_lahir' => 'required'
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
        $payments = $santri->payments()->get(); // atau bisa juga orderBy jika ingin diurutkan
        return view(
            'detail',
            [
                'title' => 'Dashboard',
                'judul' => 'Detail Santri',
                'santri' => $santri,
                'user' => $user,
                'payments' => $payments
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Santri $santri)
    {
        $user = $santri->operator;
        return view(
            'form',
            [
                'title' => 'Dashboard',
                'judul' => 'Edit Santri',
                'santri' => $santri,
                'user' => $user,
            ]
        );
    }

    public function update(Request $request, Santri $santri)
    {
        $santriData = [
            'nama' => 'required|max:255',
            'kelas' => 'required',
            // 'status_spp' => 'required',
            'golongan' => 'required',
            'tanggal_lahir' => 'required',
            'tempat_lahir' => 'required'
        ];

        $santriPayment = [
            'bulan' => 'array',
            'tahun' => 'array',
            'status' => 'array'
        ];

        if ($request->nis != $santri->nis) {
            $santri_data['nis'] = 'required|unique:santris';
        }

        $validatedData = $request->validate($santriData);
        $validatedPayment = $request->validate($santriPayment);

        $validatedData['operator_id'] = auth('web')->user()->id;

        if (Santri::where('id', $santri->id)->update($validatedData)) {
            if ($santri->status_spp != 2) {
                $bulans = $validatedPayment['bulan'];
                $tahuns = $validatedPayment['tahun'];
                $statuses = $validatedPayment['status'];

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
