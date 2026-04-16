<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister(){
        return view ('frontend.pages.register.register');
    }

    // ── REGISTER SUBMIT ───────────────────────────
    public function submitRegister(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'required|string|max:20',
            'password' => 'required|min:6|confirmed',
        ], [
            'name.required'      => 'নাম দিন',
            'email.required'     => 'Email দিন',
            'email.unique'       => 'এই Email আগেই registered',
            'phone.required'     => 'Phone number দিন',
            'password.min'       => 'Password কমপক্ষে ৬ অক্ষর',
            'password.confirmed' => 'Password মিলছে না',
        ]);

        // User create করো
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // Register এর পরে auto login
        Auth::login($user);

        return redirect()
               ->route('website')
               ->with('success', 'Registration সফল হয়েছে!');
    }

    public function showLogin(){
        return view ('frontend.pages.login.login');
    }

    // ── LOGIN SUBMIT ──────────────────────────────
    public function loginSubmit(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'Email দিন',
            'email.email'       => 'সঠিক Email দিন',
            'password.required' => 'Password দিন',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()
                   ->route('crisis.details')
                   ->with('success', 'Login সফল!');
        }

        // Login fail
        return back()
               ->withErrors(['email' => 'Email বা Password ভুল'])
               ->withInput($request->only('email'));
    }



}
