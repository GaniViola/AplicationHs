<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // primary key
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // foreign key ke users.id
            $table->integer('total_pembayaran')->default(0);
            $table->integer('kembalian')->default(0);
            $table->timestamp('tanggal_pemesanan')->useCurrent();
            $table->enum('status', ['pending', 'proses', 'selesai_pengerjaan', 'pending_setoran', 'selesai'])->default('pending');
            $table->enum('metode_pembayaran', ['tunai', 'non-tunai'])->default('tunai');
            $table->timestamps();
            $table->unsignedBigInteger('worker_id')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
