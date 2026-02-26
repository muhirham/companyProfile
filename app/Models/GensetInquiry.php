<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GensetInquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'note',
        'brand_id',
        'genset_spec_id',
    ];

    public function spec()
    {
        return $this->belongsTo(GensetSpec::class, 'genset_spec_id');
    }

    public function brand()
    {
        return $this->spec->brand();
    }
}