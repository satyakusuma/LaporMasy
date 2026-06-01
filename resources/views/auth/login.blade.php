@extends('layouts.app')

@section('title', 'Masuk Aplikasi')

@section('content')
<div class="bg-white rounded-2xl shadow-xl shadow-slate-200/80 w-full max-w-md p-6 sm:p-8 border border-slate-100">
    <div class="text-center mb-8">
        <img src="{{ asset('images/logo_inixindo.png') }}" alt="Logo LaporMasy" class="inline-block h-14 w-auto object-contain mb-3">
        <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Selamat Datang</h2>
        <p class="text-sm text-slate-500 mt-1">Silakan masuk untuk mengelola laporan Anda</p>
    </div>

    <div id="message" class="hidden mb-5 p-3.5 bg-red-50 border border-red-200 text-red-600 text-sm rounded-xl font-medium"></div>

    <form id="loginForm" class="space-y-5">
        <div>
            <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1.5">Username atau Email</label>
            <input type="text" id="loginInput" placeholder="Masukkan username/email Anda" class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 transition-all text-slate-700 placeholder-slate-400" required>
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1.5">Kata Sandi</label>
            <input type="password" id="password" placeholder="••••••••" class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 transition-all text-slate-700 placeholder-slate-400" required>
        </div>
        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-xl text-sm transition-all shadow-lg shadow-indigo-100 hover:shadow-xl cursor-pointer">
            Masuk ke Aplikasi
        </button>
    </form>

    <p class="text-sm text-center text-slate-500 mt-6">Belum memiliki akun? <a href="/register" class="text-indigo-600 font-semibold hover:underline">Daftar sekarang</a></p>
</div>

<script>
    document.getElementById('loginForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const msgDiv = document.getElementById('message');
        msgDiv.classList.add('hidden');
        msgDiv.innerText = '';

        const response = await fetch('/api/login', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                login: document.getElementById('loginInput').value,
                password: document.getElementById('password').value
            }),
            credentials: 'same-origin',
        });

        const result = await response.json();

        if (response.ok) {
            window.location.href = '/dashboard';
        } else {
            msgDiv.classList.remove('hidden');
            msgDiv.innerText = result.error || 'Login gagal. Cek kembali akun Anda.';
        }
    });
</script>
@endsection