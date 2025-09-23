<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student; // <-- 1. Add this line
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // ... other methods ...

    // Handle register form
    public function register(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Create user
        $user = User::create([
            'name' => $request->name, // Note: Your User model uses 'name', your admin uses 'full_name'. Be sure to align these later.
            'full_name' => $request->name, // Adding this to be safe with your User model
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student',
        ]);

        // 2. Add this block to create the associated Student record
        if ($user) {
            Student::create([
                'user_id' => $user->id,
                // The registration form doesn't have these fields,
                // so we need to use placeholders for now.
                'student_number' => 'REG-' . time() . $user->id, // Example: REG-16639541231
                'entry_year' => date('Y'), // Example: 2025
            ]);
        }

        // Auto login
        Auth::login($user);

        // Make sure to redirect to /home to trigger the role-based redirect
        return redirect('/home')->with('success', 'Account created successfully!');
    }
}