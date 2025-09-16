<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'course_id';
    protected $fillable = ['course_code', 'course_name', 'description', 'credits', 'image'];

    public function takes() {
        return $this->hasMany(Takes::class, 'course_id', 'course_id');
    }
}