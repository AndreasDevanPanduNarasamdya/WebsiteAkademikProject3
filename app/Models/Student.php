<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'student_id';
    protected $fillable = ['user_id', 'student_number', 'biodata', 'entry_year'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    public function takes() {
        return $this->hasMany(Takes::class, 'student_id', 'student_id');
    }
}