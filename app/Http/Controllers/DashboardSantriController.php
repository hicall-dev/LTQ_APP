<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\Payment;
use Illuminate\Http\Request;
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
                'santri' => Santri::search()->orderBy('nis')->paginate(100)
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Santri $santri)
    {
        $rules = [
            'nama' => 'required|max:255',
            'kelas' => 'required',
            'status_spp' => 'required',
            'golongan' => 'required',
        ];

        if ($request->nis != $santri->nis) {
            $rules['nis'] = 'required|unique:santris';
        }

        $validatedData = $request->validate($rules);
        $validatedData['operator_id'] = auth('web')->user()->id;

        if (Santri::where('id', $santri->id)->update($validatedData)) {

            // Optional: Memastikan updated_at pada santri ikut berubah (kalau semua data sama)
            $santri->touch();
            $now = now();

            // Update atau create payment
            $payment = Payment::updateOrCreate(
                [
                    'santri_id' => $santri->id,
                    'tahun' => $now->year,
                    'bulan' => $now->month,
                    
                ],
                [
                    'status' => $validatedData['status_spp'],
                    'operator_id' => auth('web')->user()->id
                ]
            );

            // Optional: sentuh payment biar updated_at pasti berubah
            $payment->touch();

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
