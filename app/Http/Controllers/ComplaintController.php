<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller
{
    /**
     * Menampilkan daftar pengaduan.
     * Jika user adalah admin, tampilkan semua pengaduan.
     * Jika user adalah masyarakat, tampilkan hanya pengaduan miliknya sendiri.
     */
    public function index()
    {
        $user = auth()->user();

        // Cek jika user memiliki role admin (asumsi ada kolom/kondisi admin, jika belum ada sementara tampilkan semua)
        if ($user->role === 'admin' || $user->email === 'admin@gmail.com') {
            $complaints = Complaint::with('user')->latest()->get();
        } else {
            $complaints = Complaint::where('user_id', $user->id)->latest()->get();
        }

        return view('dashboard', compact('complaints'));
    }

    /**
     * Menampilkan form untuk membuat pengaduan baru (Sisi Masyarakat).
     */
    public function create()
    {
        return view('complaints.create');
    }

    /**
     * Menyimpan data pengaduan baru ke database beserta file foto bukti.
     */
    public function store(Request $request)
    {
        // 1. Validasi Inputan
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
        ]);

        // 2. Handle Upload Foto Bukti
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Menyimpan file ke dalam folder: storage/app/public/complaints
            $imagePath = $request->file('image')->store('complaints', 'public');
        }

        // 3. Simpan ke Database
        Complaint::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
            'image_path' => $imagePath,
            'status' => 'pending', // Default status awal
        ]);

        // 4. Redirect kembali dengan pesan sukses
        return redirect()->route('complaints.index')->with('success', 'Pengaduan Anda berhasil dikirim dan sedang diproses.');
    }

    /**
     * Menampilkan detail dari satu pengaduan tertentu.
     */
    public function show(Complaint $complaint)
    {
        // Memastikan masyarakat tidak bisa mengintip laporan orang lain
        if (auth()->user()->role !== 'admin' && auth()->user()->email !== 'admin@gmail.com' && $complaint->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke laporan ini.');
        }

        return view('complaints.show', compact('complaint'));
    }

    /**
     * Menampilkan form edit pengaduan (Opsional, biasanya pengaduan tidak diedit jika sudah diproses).
     */
    public function edit(Complaint $complaint)
    {
        if ($complaint->status !== 'pending') {
            return redirect()->back()->with('error', 'Laporan yang sedang diproses tidak dapat diubah.');
        }

        return view('complaints.edit', compact('complaint'));
    }

    /**
     * Memperbarui status pengaduan (Digunakan oleh Admin untuk Disposisi/Update Status).
     */
    public function update(Request $request, Complaint $complaint)
    {
        // Validasi khusus untuk perubahan status dari Admin
        $request->validate([
            'status' => 'required|in:pending,process,resolved,rejected',
        ]);

        $complaint->update([
            'status' => $request->status,
        ]);

        return redirect()->route('complaints.index')->with('success', 'Status pengaduan berhasil diperbarui.');
    }

    /**
     * Menghapus data pengaduan (Hanya jika status masih pending).
     */
    public function destroy(Complaint $complaint)
    {
        if ($complaint->status !== 'pending') {
            return redirect()->back()->with('error', 'Laporan yang sedang diproses tidak dapat dihapus.');
        }

        // Hapus file gambar dari storage jika ada
        if ($complaint->image_path) {
            Storage::disk('public')->delete($complaint->image_path);
        }

        $complaint->delete();

        return redirect()->route('complaints.index')->with('success', 'Pengaduan berhasil dihapus.');
    }
}