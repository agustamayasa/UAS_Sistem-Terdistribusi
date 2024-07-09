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
        Schema::create('kemeja', function(Blueprint $table) {
            $table->id('id_kemeja');
            $table->string('kode_kemeja', 20);
            $table->string('nama_kemeja',60);
            $table->text('deskripsi_kemeja');
            $table->decimal('harga', 10, 3);
            $table->string('gambar_kemeja', 65);
            $table->integer('id_penjual');
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
