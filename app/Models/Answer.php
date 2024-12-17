<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $table = 'user_answers';

    protected $fillable = [
        'user_id',
        'question_id',
        'answer_value'
    ];
    public $timestamps = true;
    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke question
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
