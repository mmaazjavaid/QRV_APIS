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
        Schema::create('resellers', function (Blueprint $table) {
            $table->id();
            $table->string('email')->default("")->nullable();
            $table->string('userName')->default("")->nullable();
            $table->string('accountType')->default("Re-seller")->nullable();
            $table->string('avatar')->default("")->nullable();
            $table->string('description',500)->default("")->nullable();
            $table->string('offers',500)->default("")->nullable();
            $table->string('name')->default("")->nullable();
            $table->string('state')->default("")->nullable();
            $table->string('street')->default("")->nullable();
            $table->string('zipCode')->default("")->nullable();
            $table->integer('tokens')->default(0)->nullable();
            $table->boolean('status')->default(1)->nullable();
            $table->string('password')->default("")->nullable();
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
        Schema::dropIfExists('resellers');
    }
};
