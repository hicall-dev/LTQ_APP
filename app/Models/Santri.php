<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Santri extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'nis', 'tanggal_lahir','tempat_lahir', 'kelas', 'status_spp', 'golongan', 'operator_id'];

    public function operator(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
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
                    ->orWhere('santris.golongan', 'like', "%$search%");
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
}
