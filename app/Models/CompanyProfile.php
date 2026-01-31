<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'tagline',
        'short_description',
        'description',
        'about_image',
        'address',
        'phone',
        'email',
        'website',
        'facebook_url',
        'instagram_url',
        'linkedin_url',
        'youtube_url',
        'map_embed_url',
    ];
}
