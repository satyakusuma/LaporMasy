<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Di sini 'Table $table' sudah diganti menjadi 'Blueprint $table'
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel users (masyarakat yang melapor)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('content');
            $table->string('image_path')->nullable(); // Untuk menyimpan path foto bukti
            // Status: pending, process, resolved, rejected
            $table->enum('status', ['pending', 'process', 'resolved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};