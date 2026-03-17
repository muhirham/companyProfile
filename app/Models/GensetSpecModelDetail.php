<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GensetSpecModelDetail extends Model
{
    protected $fillable = [
        'genset_spec_id',
        'tipe_mesin',
        'nomor_silinder',
        'ukuran_silinder',
        'bore_stroke',
        'displacement',
        'kapasitas_minyak',
        'generator'
    ];

    public function spec()
    {
        return $this->belongsTo(GensetSpec::class,'genset_spec_id');
    }
}