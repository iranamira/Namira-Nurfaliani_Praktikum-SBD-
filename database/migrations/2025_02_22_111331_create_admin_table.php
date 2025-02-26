<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->id('id_admin'); // Menggunakan id() sebagai pengganti increments()
            $table->string('nama_admin');
            $table->text('alamat');
            $table->string('username');
            $table->string('password');
            $table->timestamps();
            
            $table->unique('username'); // Memisahkan unique constraint
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};