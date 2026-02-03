<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomepageSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'hero_title',
        'hero_subtitle',
        'hero_button_text',
        'hero_button_url',
        'hero_images',
        'highlight_title',
        'highlight_body',
        'years_experience',
        'projects_completed',
        'support_service',
    ];
    protected $casts = [
        'hero_images' => 'array',
    ];
}
