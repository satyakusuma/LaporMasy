<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h1>anda berhasil login</h1>
    <p>Selamat datang di Aplikasi Manajemen Pelaporan Masyarakat.</p>
    
    <hr>
    <button id="logoutBtn">Logout</button>

    <script>
        // Fungsi Logout
        document.getElementById('logoutBtn').addEventListener('click', async () => {
            const response = await fetch('/api/logout', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' }
            });

            if (response.ok) {
                alert('Anda telah logout');
                window.location.href = '/login'; // Kembali ke halaman login
            } else {
                alert('Gagal logout');
            }
        });

        // Proteksi Halaman Dashboard secara client-side (Opsional tapi bagus)
        // Kita cek apakah user valid dengan memanggil API /api/me
        async function checkAuth() {
            const response = await fetch('/api/me');
            if (!response.ok) {
                // Jika token invalid/tidak ada cookie, tendang ke login
                window.location.href = '/login';
            }
        }
        
        // Jalankan proteksi saat halaman dimuat
        checkAuth();
    </script>
</body>
</html>