<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $table = 'results';

    protected $fillable = [
        'user_id',
        'probability',
        'risk_level',
        'prediction',
        'created_at'
    ];
    public $timestamps = true;
    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
