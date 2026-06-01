<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login Aplikasi Pelaporan</h2>
    <div id="message" style="color: red;"></div>

    <form id="loginForm">
        <input type="text" id="loginInput" placeholder="Username atau Email" required><br><br>
        <input type="password" id="password" placeholder="Password" required><br><br>
        <button type="submit">Login</button>
    </form>

    <p>Belum punya akun? <a href="/register">Daftar dulu</a></p>

    <script>
        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();

            const data = {
                login: document.getElementById('loginInput').value,
                password: document.getElementById('password').value
            };

            const response = await fetch('/api/login', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (response.ok) {
                // Berhasil login, Cookie otomatis disimpan oleh browser
                window.location.href = '/dashboard';
            } else {
                document.getElementById('message').innerText = result.error || 'Login gagal.';
            }
        });
    </script>
</body>
</html>