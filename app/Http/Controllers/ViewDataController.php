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
        $user = auth()->user();

        // Verifikasi dinamis berdasarkan isi kolom role di database
        if ($user->isAdmin()) {
            $complaints = \App\Models\Complaint::with('user')->latest()->get();
            
            $stats = [
                'total' => $complaints->count(),
                'pending' => $complaints->where('status', 'pending')->count(),
                'process' => $complaints->where('status', 'process')->count(),
                'resolved' => $complaints->where('status', 'resolved')->count(),
            ];

            return view('dashboard', compact('complaints', 'stats'));
        } 
        
        // Sisi Masyarakat Biasa
        $complaints = \App\Models\Complaint::where('user_id', $user->id)->latest()->get();
        return view('dashboard', compact('complaints'));
    }
}