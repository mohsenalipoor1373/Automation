<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('number')->nullable();
            $table->string('diameter')->nullable();
            $table->string('height')->nullable();
            $table->string('yarn')->nullable();
            $table->string('verticalrope')->nullable();
            $table->string('horizontalrope')->nullable();
            $table->string('floorrope')->nullable();
            $table->string('connectingrope')->nullable();
            $table->string('double')->nullable();
            $table->longText('description')->nullable();
            $table->string('fina')->nullable();
            $table->string('off')->nullable();
            $table->string('final')->nullable();
            $table->string('date')->nullable();
            $table->string('buy')->nullable();
            $table->string('Archive')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('cages');
    }
}
