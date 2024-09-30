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
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->string('type')->nullable();
            $table->string('subject')->nullable();
            $table->string('invoice_serial_num')->nullable();
            $table->string('invoice_pdf')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->dropColumn('type');
            $table->dropColumn('subject');
            $table->dropColumn('invoice_serial_num');
            $table->dropColumn('invoice_pdf');
        });
    }
};
