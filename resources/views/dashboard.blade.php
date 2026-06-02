<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelaporan Masyarakat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1>Dashboard Pengaduan</h1>
                <p class="text-muted">Selamat datang di Aplikasi Manajemen Pelaporan Masyarakat.</p>
            </div>
            <button id="logoutBtn" class="btn btn-danger">Logout</button>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Riwayat Pengaduan Anda</h5>
                <a href="{{ route('complaints.create') }}" class="btn btn-primary">
                    + Buat Pengaduan Baru
                </a>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" class="ps-3">Tanggal</th>
                            <th scope="col">Judul Laporan</th>
                            <th scope="col">Status Progres</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($complaints as $complaint)
                            <tr>
                                <td class="ps-3">{{ $complaint->created_at->format('d M Y H:i') }}</td>
                                <td><strong>{{ $complaint->title }}</strong></td>
                                <td>
                                    @if($complaint->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending (Menunggu)</span>
                                    @elseif($complaint->status == 'process')
                                        <span class="badge bg-info text-dark">Diproses</span>
                                    @elseif($complaint->status == 'resolved')
                                        <span class="badge bg-success">Selesai</span>
                                    @elseif($complaint->status == 'rejected')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('complaints.show', $complaint->id) }}" class="btn btn-sm btn-outline-secondary">
                                        Lihat Progres
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    Anda belum pernah mengirimkan pengaduan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Fungsi Logout Terintegrasi API Anda
        document.getElementById('logoutBtn').addEventListener('click', async () => {
            const response = await fetch('/api/logout', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' }
            });

            if (response.ok) {
                alert('Anda telah logout');
                window.location.href = '/login';
            } else {
                alert('Gagal logout');
            }
        });

        // Proteksi Halaman Dashboard client-side
        async function checkAuth() {
            const response = await fetch('/api/me');
            if (!response.ok) {
                window.location.href = '/login';
            }
        }
        checkAuth();
    </script>
</body>
</html>