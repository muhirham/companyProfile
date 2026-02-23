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
        'kva',
        'kw',
        'fuel',
        'image'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

public function getImageUrlAttribute()
{
    if ($this->image && file_exists(public_path('storage/'.$this->image))) {
        return asset('storage/'.$this->image);
    }

    // fallback dummy
    return asset('genset-website/imgGenset/1.jpg');
}


}

