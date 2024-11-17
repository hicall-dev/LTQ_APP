<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
                'santri' => Santri::search()->orderBy('nama')->paginate(100)
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
            // 'operator_id' => 'required'
        ]);
        $validatedData['operator_id'] = auth('web')->user()->id;
        Santri::create($validatedData);
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
                'user' => $user
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Santri $santri)
    {
        return view(
            'form',
            [
                'title' => 'Dashboard',
                'judul' => 'Edit Santri',
                'santri' => $santri,
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
            // 'operator_id' => 'required'
        ];

        if ($request->nis != $santri->nis) {
            $rules['nis'] = 'required|unique:santris';
        }

        $validatedData = $request->validate($rules);
        $validatedData['operator_id'] = auth('web')->user()->id;

        if (Santri::where('id', $santri->id)
            ->update($validatedData)
        ) {
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
