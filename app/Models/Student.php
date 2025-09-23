<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'student_id';
    // In app/Models/Student.php
    protected $fillable = ['user_id', 'student_number', 'entry_year'];

    public function user() {
        // The 2nd argument is the foreign key on this model's table (students)
        // The 3rd argument is the primary key on the related model's table (users)
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function takes() {
        return $this->hasMany(Takes::class, 'student_id', 'student_id');
    }
}