<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('admin', function (Blueprint $table) {
            $table->enum('chronic_disease', [
                'sakit jantung',
                'asma', 
                'alergi',
                'penyakit kronis lainnya',
                'tidak memiliki penyakit kronis'
            ])->default('tidak memiliki penyakit kronis');
        });
    }

    public function down(): void
    {
        Schema::table('admin', function (Blueprint $table) {
            $table->dropColumn('chronic_disease');
        });
    }
};