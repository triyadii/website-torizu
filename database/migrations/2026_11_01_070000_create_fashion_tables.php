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
        // 1. Tabel Kategori
        Schema::create('kategori', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama', 100);
            $table->string('slug', 100)->unique();
            $table->timestamps();
        });

        // 2. Tabel Barang
        Schema::create('barang', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('kategori_id')->constrained('kategori')->cascadeOnDelete();
            $table->string('nama', 150);
            $table->text('deskripsi');
            $table->decimal('harga', 12, 2);
            $table->string('foto_utama', 255);
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });

        // 3. Tabel Varian Barang
        Schema::create('varian_barang', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('barang_id')->constrained('barang')->cascadeOnDelete();
            $table->string('ukuran', 20);
            $table->string('warna', 50);
            $table->integer('stok')->default(0);
            $table->timestamps();
        });

        // 4. Tabel Leads
        Schema::create('leads', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_pemesan', 100)->nullable();
            $table->string('nomor_wa', 20)->nullable();
            $table->foreignUuid('barang_id')->constrained('barang')->cascadeOnDelete();
            $table->foreignUuid('varian_id')->nullable()->constrained('varian_barang')->nullOnDelete();
            $table->enum('status', ['klik_wa', 'terhubung', 'closing', 'batal'])->default('klik_wa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
        Schema::dropIfExists('varian_barang');
        Schema::dropIfExists('barang');
        Schema::dropIfExists('kategori');
    }
};
