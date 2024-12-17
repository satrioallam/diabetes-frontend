<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'name', 
        'usia', 
        'usia_scale_id', 
        'gender', 
        'gender_scale_id',
        'pendidikan_scale_id', 
        'tinggi', 
        'berat', 
        'bmi', 
        'asal'
    ];
    public $timestamps = true;
    // Relasi ke scale (usia scale)
    public function usiaScale()
    {
        return $this->belongsTo(Scale::class, 'usia_scale_id');
    }

    // Relasi ke scale (gender scale)
    public function genderScale()
    {
        return $this->belongsTo(Scale::class, 'gender_scale_id');
    }

    public function pendidikanScale()
    {
        return $this->belongsTo(Scale::class, 'pendidikan_scale_id');
    }

    // Relasi ke result
    public function result()
    {
        return $this->hasOne(Result::class);
    }
}
