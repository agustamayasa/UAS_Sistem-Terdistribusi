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
        Schema::create('penjual', function(Blueprint $table) {
            $table->id('id_penjual');
            $table->string('nama_penjual', 60);
            $table->text('deskripsi_penjual');
            $table->string('kontak', 60);
            $table->string('alamat');
            $table->string('logo_penjual', 65);
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
