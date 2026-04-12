<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showRegister(){
        return view ('frontend.pages.register.register');
    }

    public function showLogin(){
        return view ('frontend.pages.login.login');
    }
}
