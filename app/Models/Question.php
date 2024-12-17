<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';

    protected $fillable = [
        'question_text',
        'scale_category'
    ];

    // Relasi ke jawaban pengguna
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function scale()
    {
        return $this->belongsTo(Scale::class);
    }
}
