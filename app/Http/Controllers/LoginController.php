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

            // Logika update status_spp dan payment
            DB::transaction(function () {
                $now = now();
                $currentYear = $now->year;
                $currentMonth = $now->month;

                $santris = Santri::all();

                foreach ($santris as $santri) {
                    // Lewati santri dengan status_spp = 2 (misalnya bebas SPP)
                    if ($santri->status_spp === 2) {
                        continue;
                    }

                    // Jika status_spp null, set ke 0 dulu
                    if (is_null($santri->status_spp)) {
                        $santri->status_spp = 0;
                        $santri->save();
                    }

                    // Ambil data payment bulan ini
                    $payment = Payment::where('santri_id', $santri->id)
                        ->where('bulan', $currentMonth)
                        ->where('tahun', $currentYear)
                        ->first();

                    // Jika tidak ada payment, buat baru dengan status = 0
                    if (!$payment) {
                        $payment = Payment::create([
                            'santri_id' => $santri->id,
                            'bulan' => $currentMonth,
                            'tahun' => $currentYear,
                            'status' => 0, // belum bayar
                            'operator_id' => auth('web')->user()->id
                        ]);
                    }

                    // Update status_spp mengikuti status payment bulan ini
                    $santri->status_spp = $payment->status;
                    $santri->save();
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
