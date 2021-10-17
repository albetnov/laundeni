<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_outlet')->constrained('outlets')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_member')->constrained('members')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_user')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->dateTime('tgl');
            $table->datetime('batas_waktu');
            $table->dateTime('tgl_bayar');
            $table->unsignedBigInteger('biaya_tambahan');
            $table->unsignedBigInteger('diskon');
            $table->unsignedBigInteger('pajak');
            $table->enum('status', ['baru', 'proses', 'selesai', 'diambil']);
            $table->enum('dibayar', ['dibayar', 'belum_dibayar']);
            $table->string('kode_invoice', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
