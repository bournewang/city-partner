<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Tx;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('txes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('from_company_id')->unsigned()->nullable();
            $table->bigInteger('to_company_id')->unsigned()->nullable();
            $table->string("type");
            $table->decimal("amount", 10,2)->nullable();
            $table->enum("status", array_keys(Tx::statusOptions()));
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('from_company_id')->references('id')->on('companies');
            $table->foreign('to_company_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('txes');
    }
};
