<?php

use App\Models\Santri;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardSantriController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('home', ['title' => 'KHOIRUNNASYIEN']);
});

Route::get('/pendaftaran', function () {
$dataKelas = [
        [
            'nama' => 'Putra Sore',
            'waktu' => '15.00 - 17.30',
            'hari' => 'Rabu, Jumat dan Sabtu',
            'pendaftaran' => 300000,
            'spp' => 200000,
        ],
        [
            'nama' => 'Putra Malam',
            'waktu' => '18.00 - 20.00',
            'hari' => 'Rabu dan Sabtu',
            'pendaftaran' => 300000,
            'spp' => 150000,
        ],
        [
            'nama' => 'Putri Sore',
            'waktu' => '15.00 - 17.30',
            'hari' => 'Selasa, Kamis dan Ahad',
            'pendaftaran' => 300000,
            'spp' => 200000,
        ],
        [
            'nama' => 'Putri Pagi',
            'waktu' => '08.00 - 10.00',
            'hari' => 'Ahad',
            'pendaftaran' => 300000,
            'spp' => 80000,
        ],
    ];
    return view('pendaftaran', compact('dataKelas'), ['title' => 'PENDAFTARAN']);
});

Route::get('/pendaftaran_', function () {
    session()->forget('data'); // Hapus session 'data'
    return redirect('/pendaftaran');
});

Route::get('/tes', function () {
    return view('formdaftar');
});


Route::get('/cek_spp', function () {
    return view('check', ['title' => 'CEK STATUS SPP']);
});

Route::get('/cek_kelas', function () {
    return view('check', ['title' => 'CEK PERKEMBANGAN SANTRI']);
});

Route::post('/daftar', [SantriController::class, 'daftar']);

Route::get('/unduh-formulir', [SantriController::class, 'unduhFormulir'])->name('unduh-formulir');

Route::get('/status_spp', [SantriController::class, 'cek']);

Route::get('/status_kelas', [SantriController::class, 'cek']);

Route::get('/dashboard/reset', [SantriController::class, 'resetStatusSPP'])->name('resetStatusSPP')->middleware('auth');
// Route::get('/dashboard', function () {
//     return view(
//         'dashboard',
//         [
//             'title' => 'Dashboard',
//             'judul' => 'Daftar Santri',
//             'santris' => Santri::search()->orderBy('nama')->paginate(10)
//         ]
//     );
// })->middleware('auth');

Route::get('/dashboard', function () {
    return redirect('/dashboard/santri');
});

Route::get('/dashboard/promo', function () {
    return view('promo', ['title' => 'Edit Promo']);
})->middleware('auth');

Route::post('/dashboard/promo', [SantriController::class, 'store'])->name('store')->middleware('auth');

Route::resource('/dashboard/santri', DashboardSantriController::class)->middleware('auth');
// Route::resource('/dashboard/santri/detail', [DashboardSantriController::class, 'edit'])->middleware('auth');

// Route::get('/santri/add', function () {
//     return view('form', ['title' => 'Dashboard', 'judul' => 'Tambah Santri']);
// });

// Route::get('/dashboard/detail/{nis}', [DashboardSantriController::class])->middleware('auth');
// Route::get('/edit/{nis}', [DashboardSantriController::class, 'update'])->middleware('auth');

// Route::get('/detail/{nis}', [SantriController::class, 'read']);
// Route::get('/edit/{nis}', [SantriController::class, 'update']);

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'auth']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);

Route::fallback(function () {
    return redirect('/');
});