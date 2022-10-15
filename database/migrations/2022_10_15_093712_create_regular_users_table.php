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
        Schema::create('regular_users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default("")->nullable();
            $table->string('userName')->default("")->nullable();
            $table->string('email')->default("")->nullable();
            $table->string('accountType')->default("regular")->nullable();
            $table->string('state')->default("")->nullable();
            $table->string('street')->default("")->nullable();
            $table->string('zipCode')->default("")->nullable();
            $table->string('password')->default("")->nullable();
            $table->integer('status')->default(1)->nullable();

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
        Schema::dropIfExists('regular_users');
    }
};
