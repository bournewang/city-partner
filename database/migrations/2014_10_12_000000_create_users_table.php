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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // $table->bigInteger('store_id')->unsigned()->nullable();
            $table->bigInteger('referer_id')->unsigned()->nullable();
            $table->string('openid', 64)->nullable()->unique();
            $table->string('platform_openid', 64)->nullable()->unique();
            $table->string('name')->nullable();
            $table->string('nickname', 32)->nullable();
            $table->string('avatar')->nullable();
            $table->integer('gender')->nullable();
            $table->string('mobile', 24)->nullable()->unique();
            $table->string('qrcode', 64)->nullable();
            $table->string('id_no', 24)->nullable();
            $table->decimal('balance', 10, 2)->nullable();
            $table->integer('level')->default(0);

            $table->string('bank_key', 24)->nullable();
            $table->string('bank_name', 32)->nullable();
            $table->string('account_no', 32)->nullable();

            $table->boolean('status')->default(1);
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('api_token', 80)->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('referer_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
