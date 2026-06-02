@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Kirim Pengaduan Baru</h5>
                </div>
                <div class="card-body">
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('complaints.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Judul Pengaduan</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="Contoh: Jalan Rusak di RT 03" required>
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Isi Laporan / Pengaduan</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5" placeholder="Jelaskan secara rinci mengenai pengaduan Anda..." required>{{ old('content') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="image" class="form-label">Foto Bukti (Opsional)</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" accept="image/*">
                            <div class="form-text">Format yang didukung: JPG, JPEG, PNG. Maksimal 2MB.</div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ url('/dashboard') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Kirim Laporan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection