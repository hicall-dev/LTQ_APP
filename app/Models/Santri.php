<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Santri extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'nis', 'kelas', 'status_spp', 'golongan', 'operator_id'];

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
        $query->where('santris.nama', 'like', '%' . request('search') . '%')
            ->orWhere('santris.nis', 'like', '%' . request('search') . '%')
            ->orWhere('santris.golongan', 'like', '%' . request('search') . '%');
    }

    public function getRouteKeyName()
    {
        return 'nis';
    }
}
