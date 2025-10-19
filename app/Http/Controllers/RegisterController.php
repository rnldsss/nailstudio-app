<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Display the registration form.
     */
    public function showRegistrationForm()
    {
        return view('admin.register');
    }

    /**
     * Handle a simulated registration request.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|min:4',
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:member,admin',
        ]);

        // Registration persistence is not available yet; just simulate success.
        return redirect()
            ->route('login')
            ->with('success', "Registrasi untuk {$validated['username']} berhasil disimulasikan. Silakan login.");
    }
}
