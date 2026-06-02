<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            
            <div class="mb-3">
                <a href="{{ url('/dashboard') }}" class="btn btn-secondary">&larr; Kembali ke Dashboard</a>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detail Laporan #{{ $complaint->id }}</h5>
                    <span>{{ $complaint->created_at->format('d F Y') }}</span>
                </div>
                <div class="card-body p-4">
                    
                    <div class="mb-4">
                        <span class="text-muted d-block mb-1">Status Saat Ini:</span>
                        @if($complaint->status == 'pending')
                            <h4 class="badge bg-warning text-dark p-2">PENDING (Menunggu Verifikasi Admin)</h4>
                        @elseif($complaint->status == 'process')
                            <h4 class="badge bg-info text-dark p-2">PROSES (Sedang Ditindaklanjuti)</h4>
                        @elseif($complaint->status == 'resolved')
                            <h4 class="badge bg-success p-2">SELESAI (Laporan Ditutup)</h4>
                        @elseif($complaint->status == 'rejected')
                            <h4 class="badge bg-danger p-2">DITOLAK</h4>
                        @endif
                    </div>

                    <div class="mb-4">
                        <h3>{{ $complaint->title }}</h3>
                        <p class="text-muted" style="white-space: pre-line;">
                            {{ $complaint->content }}
                        </p>
                    </div>

                    <div class="mb-4">
                        <h5>Foto Bukti:</h5>
                        @if($complaint->image_path)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $complaint->image_path) }}" alt="Foto Bukti" class="img-fluid rounded shadow-sm" style="max-height: 400px;">
                            </div>
                        @else
                            <p class="text-muted italic">Tidak ada foto bukti yang dilampirkan.</p>
                        @endif
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>