<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Takes extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'takes_id';
    protected $fillable = ['student_id', 'course_id', 'enroll_date', 'grade', 'status'];
}