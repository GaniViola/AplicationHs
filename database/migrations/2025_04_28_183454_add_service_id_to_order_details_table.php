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
        Schema::table('order_details', function (Blueprint $table) {
            $table->unsignedBigInteger('service_id')->after('id_orders');
    
            // Menambahkan foreign key untuk relasi ke tabel services
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });
    }
    
    public function down(): void
    {
        Schema::table('order_details', function (Blueprint $table) {
            // Pastikan foreign key dihapus terlebih dahulu
            if (Schema::hasColumn('order_details', 'service_id')) {
                $table->dropForeign(['service_id']);
                $table->dropColumn('service_id');
            }
        });
    }
    
};    
