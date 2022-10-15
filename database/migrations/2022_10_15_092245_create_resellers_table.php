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
        // Schema::create('resellers', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('email')->default("")->nullable();
        //     $table->string('userName')->default("")->nullable();
        //     $table->string('accounttype')->default("Re-seller")->nullable();
        //     $table->string('avatar')->default("")->nullable();
        //     $table->string('description')->default("")
        //     $table->timestamps();
        // });
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
