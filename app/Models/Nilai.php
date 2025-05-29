<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nilai extends Model
{
    use HasFactory;

    protected $fillable = [
        'santri_id',
        'hafalan',
        'perkembangan',
        'akhlak',
        'tahun',
        'bulan',
        'operator_id',
    ];

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }

    public function operator()
    {
        return $this->belongsTo(User::class, 'operator_id');
    }
}
