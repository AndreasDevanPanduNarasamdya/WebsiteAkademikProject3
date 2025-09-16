<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'user_id';
    protected $fillable = ['username', 'password', 'role', 'full_name', 'profile_image'];

    public function student() {
        return $this->hasOne(Student::class, 'user_id', 'user_id');
    }
}