<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penjualans', function (Blueprint $table) {

            $table->id();

            $table->date('tanggal');

            $table->foreignId('produk_id')
                ->constrained('produks')
                ->cascadeOnDelete();

            $table->integer('jumlah_terjual');

            $table->decimal('harga_jual', 15, 2);

            $table->decimal('total_penjualan', 15, 2);

            $table->decimal('hpp', 15, 2)
                ->default(0);

            $table->decimal('keuntungan', 15, 2)
                ->default(0);

            $table->text('catatan')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};