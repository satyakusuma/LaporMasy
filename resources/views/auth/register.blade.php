<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register Masyarakat</title>
</head>
<body>
    <h2>Form Pendaftaran Masyarakat</h2>
    <div id="message" style="color: red;"></div>

    <form id="registerForm">
        <input type="text" id="username" placeholder="Username (huruf kecil, tanpa spasi)" required><br><br>
        <input type="text" id="name" placeholder="Nama Lengkap" required><br><br>
        <input type="text" id="nik" placeholder="NIK (16 Digit)" required><br><br>
        <textarea id="alamat" placeholder="Alamat Lengkap" required></textarea><br><br>
        <input type="email" id="email" placeholder="Email" required><br><br>
        <input type="text" id="no_hp" placeholder="Nomor HP" required><br><br>
        <input type="password" id="password" placeholder="Password" required><br><br>
        <input type="password" id="password_confirmation" placeholder="Konfirmasi Password" required><br><br>
        <button type="submit">Daftar</button>
    </form>

    <p>Sudah punya akun? <a href="/login">Login di sini</a></p>

    <script>
        document.getElementById('registerForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
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
                window.location.href = '/login'; // Pindah ke login jika sukses
            } else {
                // Tampilkan error pertama yang dikembalikan backend
                document.getElementById('message').innerText = Object.values(result.errors || result)[0];
            }
        });
    </script>
</body>
</html>