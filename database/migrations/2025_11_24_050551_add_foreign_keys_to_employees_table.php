<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            // PERBAIKAN: Mengubah 'departements_id' menjadi 'departemen_id'
            $table->unsignedBigInteger('departemen_id')->after('tanggal_masuk')->nullable();
            $table->unsignedBigInteger('jabatan_id')->after('departemen_id')->nullable();
            
            // Definisi Foreign Key 
            $table->foreign('departemen_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('jabatan_id')->references('id')->on('positions')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            // PERBAIKAN: Pastikan nama foreign key konsisten saat rollback
            $table->dropForeign(['departemen_id']);
            $table->dropForeign(['jabatan_id']);
            
            // Hapus kolom
            $table->dropColumn(['departemen_id', 'jabatan_id']);
        });
    }
};