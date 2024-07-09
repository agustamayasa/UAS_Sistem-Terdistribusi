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
        //
        Schema::create('transaksi', function(Blueprint $table) {
            $table->id('id_transaksi');
            $table->integer('id_kemeja');
            $table->string('nama_pelanggan', 60);
            $table->date('tanggal');
            $table->integer('jumlah');
            $table->decimal('total_harga', 10, 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
