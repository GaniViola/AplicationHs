<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetoransTable extends Migration
{
    public function up()
    {
        Schema::create('setorans', function (Blueprint $table) {
            $table->id('id_setoran');
            $table->foreignId('id_orders')->constrained('orders')->onDelete('cascade');
            $table->foreignId('id')->constrained('users')->onDelete('cascade');
            $table->integer('jumlah_setoran');
            $table->timestamp('tanggal_setoran')->useCurrent();
            $table->enum('status_setoran', ['pending', 'disetorkan', 'selesai', 'kurang'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('setorans');
    }
}
