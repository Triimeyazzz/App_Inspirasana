<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggota', function (Blueprint $table) {
            $table->id('id_anggota')->primary();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_kategori')->constrained('kategoris')->onDelete('cascade');
            $table->foreignId('id_role')->constrained('roles')->onDelete('cascade');
            $table->foreignId('id_kelompok')->nullable()->constrained('kelompoks')->onDelete('cascade');
            $table->string('kode_anggota')->unique();
            $table->string('nama_anggota');
            $table->enum('jk', ['l', 'p']);
            $table->date('tgl_lahir');
            $table->text('alamat');
            $table->string('no_hp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anggota');
    }
}
