<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('file');
            $table->string('file_name')->nullable();
            $table->integer('menu_id');
            $table->integer('user_id');
            $table->text('catatan_verifikator')->nullable();
            $table->text('catatan_direktur')->nullable();
            $table->enum('status_verifikator', ['pending', 'approved', 'rejected'])->default('pending');
            $table->enum('status_direktur', ['pending', 'approved', 'rejected'])->default('pending');
            $table->enum('status',['rejected to user','rejected to verifikator','waiting to approve verifikator','waiting to approve direktur','approve'])->default('waiting to approve verifikator');
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
        Schema::dropIfExists('pengajuans');
    }
}
