<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produks', function (Blueprint $table) {

            $table->id();

            $table->string('nama');

            $table->string('kategori');

            $table->decimal('harga_jual', 15, 2);

            $table->integer('jumlah_produksi')->default(0);

            $table->decimal('total_bahan', 15, 2)->default(0);

            $table->decimal('total_biaya_tambahan', 15, 2)->default(0);

            $table->decimal('total_modal', 15, 2)->default(0);

            $table->decimal('hpp', 15, 2)->default(0);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};