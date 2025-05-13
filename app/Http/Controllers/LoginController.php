<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Santri;
use App\Models\Payment;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view(
            'login.index',
            ['title' => 'Login']
        );
    }

    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|min:5|max:255',
            'password' => 'required|min:5|max:255'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Mulai logika update status_spp dan payment
            DB::transaction(function () {
                $now = now();
                $currentYear = $now->year;
                $currentMonth = $now->month;

                // 1. Set status_spp yang null menjadi 0, tapi abaikan yang status_spp = 2
                Santri::whereNull('status_spp')
                    ->where('status_spp', '!=', 2)
                    ->update(['status_spp' => 0]);

                // 2. Ambil semua santri kecuali yang status_spp = 2
                $santris = Santri::where('status_spp', '!=', 2)->get();

                foreach ($santris as $santri) {
                    $exists = Payment::where('santri_id', $santri->id)
                        ->where('bulan', $currentMonth)
                        ->where('tahun', $currentYear)
                        ->exists();

                    if (!$exists) {
                        Payment::create([
                            'santri_id' => $santri->id,
                            'bulan' => $currentMonth,
                            'tahun' => $currentYear,
                            'status' => 0, // 0 = belum bayar
                            'operator_id' => auth('web')->user()->id
                        ]);
                    }
                }
            });
            return redirect()->intended('/dashboard/santri');
        }

        return back()->with('loginError', 'Login Gagal!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // request()->session()->invalidate();
        return redirect('/');
    }
}
