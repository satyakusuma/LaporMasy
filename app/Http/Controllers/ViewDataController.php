<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewDataController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function showRegister() {
        return view('auth.register');
    }

    public function showDashboard() {
        return view('dashboard');
    }
}