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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('book_id')->constrained()->cascadeOnDelete();
            $table->string('kelas')->nullable();
            $table->string('jurusan')->nullable();
            $table->date('tanggal_peminjaman');
            $table->date('tanggal_kembali')->nullable();
            $table->enum('status', [
                'pengambilan',
                'dipinjam',
                'kembali',
                'terlambat',
                'dibatalkan',
            ])->default('pengambilan');
            $table->timestamp('cancelled_at')->nullable();
            $table->string('cancelled_reason')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->timestamp('diambil_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
