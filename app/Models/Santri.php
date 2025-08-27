<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Santri extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'nis', 'tanggal_lahir', 'tempat_lahir', 'kelas', 'status_spp', 'golongan', 'operator_id', 'pembimbing_id'];

    public function operator(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pembimbing()
    {
        return $this->belongsTo(User::class, 'pembimbing_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function nilais()
    {
        return $this->hasMany(Nilai::class);
    }

    public function setorans()
    {
        return $this->hasMany(Setoran::class);
    }

    public function scopeSearch(Builder $query): void
    {
        // dd(request());
        $search = request('search');
        $spp = request('spp');

        if ($search !== null && $search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('santris.nama', 'like', "%$search%")
                    ->orWhere('santris.nis', 'like', "%$search%")
                    ->orWhere('santris.golongan', 'like', "%$search%")
                    ->orWhere('santris.kelas', 'like', "%$search%");
            });
        }

        if ($spp !== null && $spp !== '') {
            $query->where('santris.status_spp', $spp);
        }
    }

    public function getRouteKeyName()
    {
        return 'nis';
    }

    public function scopeSearchByNilai(Builder $query): void
    {
        /// Status
        // semua, belum_ditambahkan, sudah_ditambahkan
        $currentYear = now()->year;
        $currentMonth = now()->month;
        $query->whereHas('nilais', function($q) use ($currentYear, $currentMonth) {
            $q->where('tahun', $currentYear)
                ->where('bulan', '<=', $currentMonth);
        });
    }
}
