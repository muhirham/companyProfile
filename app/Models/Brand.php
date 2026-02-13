<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'logo',
        'is_active'
    ];

    public function specs()
    {
        return $this->hasMany(GensetSpec::class);
    }

    public function images()
    {
        return $this->hasMany(GensetImage::class);
    }

    public function getLogoUrlAttribute()
    {
        // kalau ada upload manual di storage
        if ($this->logo && file_exists(public_path('storage/' . $this->logo))) {
            return asset('storage/' . $this->logo);
        }

        // fallback ke dummy folder berdasarkan slug
        $dummyPath = public_path('genset-website/img/brand/' . $this->slug . '.png');

        if (file_exists($dummyPath)) {
            return asset('genset-website/img/brand/' . $this->slug . '.png');
        }

        // fallback terakhir kalau ga ada file
        return asset('genset-website/img/brand/default.png');
    }

    
}

