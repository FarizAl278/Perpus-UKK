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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('cover')->nullable();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('sub_judul')->nullable();
            $table->text('sinopsis')->nullable();
            $table->string('penulis');
            $table->string('penerbit');
            $table->foreignId('genres_id')->constrained()->cascadeOnDelete();
            $table->year('tahun_terbit')->nullable();
            $table->integer('stok')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
