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
    Schema::table('employees', function (Blueprint $table) {
        // Menambah kolom foreign key
        $table->unsignedBigInteger('departements_id')->after('tanggal_masuk')->nullable(); // Tambah nullable untuk keamanan data lama
        $table->unsignedBigInteger('jabatan_id')->after('departements_id')->nullable();
        
        // Definisi Foreign Key 
        $table->foreign('departements_id')->references('id')->on('departments')->onDelete('cascade');
        $table->foreign('jabatan_id')->references('id')->on('positions')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::table('employees', function (Blueprint $table) {
        $table->dropForeign(['departements_id']);
        $table->dropForeign(['jabatan_id']);
        $table->dropColumn(['departemen_id', 'jabatan_id']);
    });
}};
