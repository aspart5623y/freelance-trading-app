<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('trader_id')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');   
            $table->string('title');  
            $table->string('description')->nullable();  
            $table->foreignUuid('service_id')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');   
            $table->integer('roi');  
            $table->integer('duration');  
            $table->float('minimum_amount', 12,2);   
            $table->float('maximum_amount', 12,2);  
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
        Schema::dropIfExists('packages');
    }
}
