<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    /**
     * Mass assignable
     */
    protected $fillable = [
        'name',
        'slug',
        'type',
        'short_description',
        'description',
        'image',
        'is_active',
    ];
    

    /**
     * Casts
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope: hanya service aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: filter berdasarkan type
     */
    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Accessor: URL gambar
     */
    public function getImageUrlAttribute()
    {
        if ($this->image && file_exists(public_path('storage/' . $this->image))) {
            return asset('storage/' . $this->image);
        }

        // fallback dummy berdasarkan type
        switch ($this->type) {
            case 'installation':
                return asset('genset-website/imgGenset/1.jpg');
            case 'maintenance':
                return asset('genset-website/imgGenset/2.jpg');
            case 'rental':
                return asset('genset-website/imgGenset/3.jpg');
            default:
                return asset('genset-website/imgGenset/1.jpg');
        }
    }


}
