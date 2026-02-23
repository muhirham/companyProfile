<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'status',
        'image_path',
    ];
    public function getImageUrlAttribute()
{
    // Kalau ada upload dari storage
    if ($this->image_path && file_exists(public_path('storage/' . $this->image_path))) {
        return asset('storage/' . $this->image_path);
    }

    // Dummy random berdasarkan ID biar beda-beda
    $dummyNumber = ($this->id % 4) + 1;

    $dummyPath = public_path('genset-website/imgGenset/' . $dummyNumber . '.jpg');

    if (file_exists($dummyPath)) {
        return asset('genset-website/imgGenset/' . $dummyNumber . '.jpg');
    }

    // fallback terakhir
    return asset('genset-website/imgGenset/1.jpg');
}

}
