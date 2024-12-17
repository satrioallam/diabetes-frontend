<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scale extends Model
{
    use HasFactory;

    protected $table = 'scales';

    protected $fillable = [
        'description',
        'value',
        'category'
    ];

    // Relasi ke users (usia scale)
    public function users()
    {
        return $this->hasMany(Users::class, 'usia_scale_id');
    }
    
}
