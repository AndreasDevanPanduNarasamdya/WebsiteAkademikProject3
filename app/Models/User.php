<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'full_name', // <-- Make sure this is present
        'email',
        'password',
        'role',
        'username',
        'profile_image',
    ];

    // ... rest of your model

    public function student() {
        // The 2nd argument is the foreign key on the students table
        // The 3rd argument is the primary key on the users table
        return $this->hasOne(Student::class, 'user_id', 'id');
    }
}