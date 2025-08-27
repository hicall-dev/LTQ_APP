<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setoran extends Model
{
    protected $fillable = ['santri_id', 'hafalan', 'bulan', 'tahun'];
}
