<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_links', function (Blueprint $table) {
             $table->id();
            $table->integer('userId');
            $table->integer('cardId');
            $table->string('linkName')->default('')->nullable();
            $table->string('linkUrl')->default('')->nullable(); 
            $table->string('linkImg')->default('')->nullable(); 
            $table->integer('clicks')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_links');
    }
};
