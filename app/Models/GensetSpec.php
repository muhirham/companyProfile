<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GensetSpec extends Model
{
    protected $fillable = [
        'brand_id',
        'model',
        'engine',
        'alternator',

        'prp_kva',
        'esp_kva',
        'prp_kw',
        'esp_kw',

        'fuel',

        'l_open',
        'w_open',
        'h_open',
        'kg_open',

        'l_silent',
        'w_silent',
        'h_silent',
        'kg_silent',

        'image'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function modelDetail()
    {
        return $this->hasOne(GensetSpecModelDetail::class);
    }

    public function getImageUrlAttribute()
    {
        if ($this->image && file_exists(public_path('storage/'.$this->image))) {
            return asset('storage/'.$this->image);
        }

        return asset('genset-website/imgGenset/1.jpg');
    }
}