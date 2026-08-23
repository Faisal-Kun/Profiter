<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bahan_produks', function (Blueprint $table) {

            $table->id();

            $table->foreignId('produk_id')
                ->constrained('produks')
                ->onDelete('cascade');

            $table->string('nama');

            $table->decimal('jumlah', 10, 2);

            $table->string('satuan');

            $table->decimal('harga_satuan', 15, 2);

            $table->decimal('total', 15, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bahan_produks');
    }
};