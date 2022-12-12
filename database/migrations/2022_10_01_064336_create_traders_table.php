<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('phone')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('pin')->nullable();
            $table->string('profile_img')->nullable();
            $table->string('nationality')->nullable();
            $table->integer('percentage')->nullable();
            $table->text('expertise')->nullable();
            $table->float('wallet_balance', 12,2)->default(0.00);
            $table->boolean('show_admin_rating')->default(0);
            $table->boolean('verify')->default(0);
            $table->integer('admin_rating')->default(0);
            $table->enum('liquidity', ['high', 'medium', 'low'])->nullable();
            $table->string('liquidity_amt')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('traders');
    }
}
