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
        Schema::create('sembakokeluars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('unit_id');
            $table->string('name');
            $table->date('date')->nullable();
            $table->date('out_date');
            $table->date('exp_date');
            $table->integer('amount');
            $table->unsignedBigInteger('sembakomasuk_id');
            $table->foreign('sembakomasuk_id')->references('id')->on('sembakomasuks');
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
        Schema::dropIfExists('sembakokeluars');
    }
};
