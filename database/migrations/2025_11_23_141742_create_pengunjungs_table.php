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
        Schema::create('pengunjung', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('id_buku');
            $table->string('nis', 100)->nullable();
            $table->string('nama', 100)->nullable();
            $table->string('kelas', 100)->nullable();
            $table->date('tgl_pinjam')->nullable();
            $table->date('tgl_kembali')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengunjung');
    }
};
