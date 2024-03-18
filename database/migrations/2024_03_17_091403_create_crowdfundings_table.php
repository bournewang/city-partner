<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\CrowdFunding;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('crowd_fundings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->boolean('paid_deposit')->default(false);
            $table->datetime('success_at')->nullable();
            $table->datetime('returned_at')->nullable();
            $table->enum("status", array_keys(CrowdFunding::statusOptions()))->default(CrowdFunding::APPLYING);
            $table->string('comment')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crowd_fundings');
    }
};
