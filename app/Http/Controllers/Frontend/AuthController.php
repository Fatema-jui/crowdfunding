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

    //  REGISTER SUBMIT 
    public function submitRegister(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'required|string|max:20',
            'password' => 'required|min:6|confirmed',
        ], [
            'name.required'      => 'Name is required',
            'email.required'     => 'Email is required',
            'email.unique'       => 'This email is already registered',
            'phone.required'     => 'Phone number is required',
            'password.min'       => 'Password must be at least 6 characters',
            'password.confirmed' => 'Password confirmation does not match',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
            'role'     => 'donor',
        ]);

        Auth::login($user);

        // new parameter to redirect to the intended page after registration    
        $redirect = $request->input('redirect');
        return redirect($redirect ?: route('website'))
               ->with('success', 'Registration successful!');
    }

    public function showLogin(){
        return view ('frontend.pages.login.login');
    }

    //  LOGIN SUBMIT 
    public function loginSubmit(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'Email is required',
            'email.email'       => 'Provide a valid email',
            'password.required' => 'Password is required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if(Auth::user()->role == 'admin') {
                return redirect()->route('dashboard')
                          ->with('success', 'Login successful! Welcome Admin');
            }

            $redirect = $request->input('redirect');
            return redirect($redirect ?: route('website'))
                   ->with('success', 'Login successful!');
        }

        return back()
               ->withErrors(['email' => 'Email or Password is incorrect'])
               ->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('website');
    }
}