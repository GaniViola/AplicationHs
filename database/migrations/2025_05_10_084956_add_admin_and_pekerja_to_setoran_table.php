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
        Schema::table('setorans', function (Blueprint $table) {
    $table->integer('jumlah_admin')->after('jumlah_setoran')->default(0);
    $table->integer('jumlah_pekerja')->after('jumlah_admin')->default(0);
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('setoran', function (Blueprint $table) {
            //
        });
    }
};
