<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Judul Dinamis -->
    <title>@yield('title', 'LaporMasy')</title>
    
    <!-- MASTER FAVICON (Cukup ditulis sekali di sini) -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo_inixindo.png') }}">
    
    <!-- MASTER FONTS & CDN (Cukup ditulis sekali di sini) -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 to-slate-100 min-h-screen flex items-center justify-center p-4">

    <!-- Tempat menyuntikkan konten unik dari halaman lain -->
    @yield('content')

</body>
</html>