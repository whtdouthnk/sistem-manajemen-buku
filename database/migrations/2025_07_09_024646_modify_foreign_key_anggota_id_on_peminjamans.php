<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyForeignKeyAnggotaIdOnPeminjamans extends Migration
{
    public function up(): void
    {
        Schema::table('peminjamans', function (Blueprint $table) {
            // Drop foreign key lama
            $table->dropForeign(['anggota_id']);

            // Tambahkan foreign key baru dengan restrict
            $table->foreign('anggota_id')
                ->references('id')
                ->on('anggotas')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::table('peminjamans', function (Blueprint $table) {
            // Kembalikan ke cascade jika rollback
            $table->dropForeign(['anggota_id']);

            $table->foreign('anggota_id')
                ->references('id')
                ->on('anggotas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }
}
