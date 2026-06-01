@extends('layouts.app')

@section('title', 'Daftar Akun Masyarakat')

@section('content')
<div class="bg-white rounded-2xl shadow-xl shadow-slate-200/80 w-full max-w-2xl overflow-hidden border border-slate-100 flex flex-col md:flex-row">
    <!-- Panel Samping Info -->
    <div class="hidden md:flex md:w-5/12 bg-indigo-600 p-8 flex-col justify-between text-white">
        <div>
            <img src="{{ asset('images/logo_inixindo.png') }}" alt="Logo LaporMasy" class="h-10 w-auto object-contain mb-6 filter brightness-0 invert">
            <h3 class="text-xl font-bold mb-2">LaporMasy</h3>
            <p class="text-sm text-indigo-100 leading-relaxed">Sistem manajemen pelaporan digital untuk aspirasi dan pengaduan masyarakat yang cepat, tanggap, dan transparan.</p>
        </div>
        <div class="text-xs text-indigo-200">© 2026 E-Government Platform</div>
    </div>

    <!-- Area Form -->
    <div class="p-6 sm:p-8 flex-1">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Mulai Perubahan</h2>
            <p class="text-sm text-slate-500 mt-1">Lengkapi data diri Anda untuk membuat akun pelaporan.</p>
        </div>

        <div id="message" class="hidden mb-4 p-3.5 bg-red-50 border border-red-200 text-red-600 text-sm rounded-xl font-medium"></div>

        <form id="registerForm" class="space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1.5">Username</label>
                    <input type="text" id="username" placeholder="cth: satya_tegar" class="w-full px-3.5 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 transition-all text-slate-700 placeholder-slate-400" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1.5">Nama Lengkap</label>
                    <input type="text" id="name" placeholder="Nama sesuai KTP" class="w-full px-3.5 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 transition-all text-slate-700 placeholder-slate-400" required>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1.5">NIK (16 Digit)</label>
                    <input type="text" id="nik" placeholder="3402xxxxxxxxxxxx" maxlength="16" class="w-full px-3.5 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 transition-all text-slate-700 placeholder-slate-400" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1.5">Nomor HP</label>
                    <input type="tel" id="no_hp" placeholder="08xxxxxxxxxx" class="w-full px-3.5 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 transition-all text-slate-700 placeholder-slate-400" required>
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1.5">Alamat Email</label>
                <input type="email" id="email" placeholder="nama@email.com" class="w-full px-3.5 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 transition-all text-slate-700 placeholder-slate-400" required>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1.5">Alamat Domisili</label>
                <textarea id="alamat" rows="2" placeholder="Tuliskan alamat lengkap sesuai domisili..." class="w-full px-3.5 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 transition-all text-slate-700 placeholder-slate-400 resize-none" required></textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1.5">Password</label>
                    <input type="password" id="password" placeholder="••••••••" class="w-full px-3.5 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 transition-all text-slate-700 placeholder-slate-400" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1.5">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" placeholder="••••••••" class="w-full px-3.5 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 transition-all text-slate-700 placeholder-slate-400" required>
                </div>
            </div>

            <button type="submit" class="w-full mt-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-xl text-sm transition-all shadow-lg shadow-indigo-100 hover:shadow-xl cursor-pointer">
                Daftar Sekarang
            </button>
        </form>

        <p class="text-sm text-center text-slate-500 mt-5">Sudah memiliki akun? <a href="/login" class="text-indigo-600 font-semibold hover:underline">Masuk disini</a></p>
    </div>
</div>

<script>
    document.getElementById('registerForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const msgDiv = document.getElementById('message');
        msgDiv.classList.add('hidden');
        msgDiv.innerText = '';
        
        const data = {
            username: document.getElementById('username').value,
            name: document.getElementById('name').value,
            nik: document.getElementById('nik').value,
            alamat: document.getElementById('alamat').value,
            email: document.getElementById('email').value,
            no_hp: document.getElementById('no_hp').value,
            password: document.getElementById('password').value,
            password_confirmation: document.getElementById('password_confirmation').value,
        };

        const response = await fetch('/api/register', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (response.ok) {
            alert(result.message);
            window.location.href = '/login';
        } else {
            msgDiv.classList.remove('hidden');
            if(result.errors) {
                msgDiv.innerText = Object.values(result.errors)[0][0];
            } else {
                msgDiv.innerText = result.message || 'Gagal mendaftar.';
            }
        }
    });
</script>
@endsection